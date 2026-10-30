<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('MIDTRANS WEBHOOK MASUK', [
            'order_id' => $request->input('order_id'),
            'transaction_status' => $request->input('transaction_status'),
        ]);

        try {
            $orderId = $request->input('order_id');
            $statusCode = $request->input('status_code');
            $grossAmount = $request->input('gross_amount');
            $signatureKey = $request->input('signature_key');
            $transactionStatus = $request->input('transaction_status');
            $fraudStatus = $request->input('fraud_status');

            if (
                !$orderId ||
                !$statusCode ||
                !$grossAmount ||
                !$signatureKey ||
                !$transactionStatus
            ) {
                Log::warning('Data notifikasi Midtrans tidak lengkap.');

                return response()->json([
                    'message' => 'Data notifikasi tidak lengkap.',
                ], 400);
            }

            // Verifikasi signature Midtrans.
            $serverKey = config('services.midtrans.server_key');

            if (!$serverKey) {
                Log::error(
                    'Server Key Midtrans belum dikonfigurasi.'
                );

                return response()->json([
                    'message' => 'Konfigurasi pembayaran belum tersedia.',
                ], 500);
            }

            $expectedSignature = hash(
                'sha512',
                $orderId . $statusCode . $grossAmount . $serverKey
            );

            if (!hash_equals($expectedSignature, $signatureKey)) {
                Log::warning(
                    'Signature notifikasi Midtrans tidak valid.',
                    ['order_id' => $orderId]
                );

                return response()->json([
                    'message' => 'Signature tidak valid.',
                ], 403);
            }

            // Petakan status Midtrans ke status aplikasi.
            $statusBaru = match ($transactionStatus) {
                'settlement' => 'Berhasil',

                'capture' => $fraudStatus === 'accept'
                    ? 'Berhasil'
                    : 'Pending',

                'pending' => 'Pending',

                'deny', 'cancel', 'expire' => 'Gagal',

                'refund', 'partial_refund' => 'Refund',

                default => null,
            };

            if ($statusBaru === null) {
                Log::info('Status transaksi Midtrans tidak diproses.', [
                    'order_id' => $orderId,
                    'transaction_status' => $transactionStatus,
                ]);

                return response()->json([
                    'message' => 'Status transaksi tidak diproses.',
                ], 200);
            }

            // Perbarui status pembayaran di database.
            $hasilUpdate = DB::transaction(function () use (
                $orderId,
                $statusBaru
            ) {
                $pembayaran = Pembayaran::where(
                    'transaksi_id',
                    $orderId
                )->lockForUpdate()->first();

                if (!$pembayaran) {
                    return [
                        'ditemukan' => false,
                        'baru_berhasil' => false,
                    ];
                }

                $sebelumnyaBerhasil =
                    $pembayaran->status_pembayaran === 'Berhasil';

                $pembayaran->status_pembayaran = $statusBaru;

                if (
                    $statusBaru === 'Berhasil' &&
                    !$sebelumnyaBerhasil
                ) {
                    $pembayaran->tanggal_pembayaran = now();
                }

                $pembayaran->save();

                return [
                    'ditemukan' => true,
                    'baru_berhasil' => (
                        $statusBaru === 'Berhasil' &&
                        !$sebelumnyaBerhasil
                    ),
                ];
            });

            if (!$hasilUpdate['ditemukan']) {
                Log::warning(
                    'Transaksi tidak ditemukan saat pembaruan database.',
                    ['order_id' => $orderId]
                );

                return response()->json([
                    'message' => 'Transaksi tidak ditemukan.',
                ], 404);
            }

            Log::info('Status pembayaran berhasil diperbarui.', [
                'order_id' => $orderId,
                'status_pembayaran' => $statusBaru,
            ]);

            // Kirim notifikasi ketika pembayaran baru berhasil.
            if ($hasilUpdate['baru_berhasil']) {
                $this->kirimWhatsApp($orderId);
            }

            return response()->json([
                'message' => 'Notifikasi berhasil diproses.',
            ], 200);

        } catch (Throwable $e) {
            Log::error('Gagal memproses webhook Midtrans.', [
                'order_id' => $request->input('order_id'),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Gagal memproses notifikasi.',
            ], 500);
        }
    }

    /**
     * Mengirim notifikasi WhatsApp pembayaran.
     */
    private function kirimWhatsApp(string $orderId): void
    {
        try {
            $pembayaran = Pembayaran::with('pesanan.user')
                ->where('transaksi_id', $orderId)
                ->first();

            $user = $pembayaran?->pesanan?->user;

            if (!$user || empty($user->no_hp)) {
                Log::warning(
                    'WhatsApp tidak dikirim: nomor pelanggan kosong.',
                    ['order_id' => $orderId]
                );

                return;
            }

            $token = config('services.fonnte.token');

            if (empty($token)) {
                Log::error(
                    'WhatsApp tidak dikirim: token Fonnte belum dikonfigurasi.',
                    ['order_id' => $orderId]
                );

                return;
            }

            // Bersihkan nomor HP.
            $nomor = preg_replace('/\D+/', '', $user->no_hp) ?? '';

            // Ubah nomor ke format internasional Indonesia.
            if (str_starts_with($nomor, '0')) {
                $nomor = '62' . substr($nomor, 1);
            } elseif (str_starts_with($nomor, '8')) {
                $nomor = '62' . $nomor;
            }

            if (!preg_match('/^62[0-9]{8,13}$/', $nomor)) {
                Log::warning('Nomor HP pelanggan tidak valid.', [
                    'order_id' => $orderId,
                ]);

                return;
            }

            $nama = $user->name
                ?? $user->nama
                ?? 'Pelanggan';

            $pesan = "Halo, Kak {$nama}! 👋\n\n"
                . "Kabar baik dari JAITIN - Toko Jahit Lina! 💗\n\n"
                . "Pembayaran pesanan jahit Kakak telah berhasil kami terima.\n\n"
                . "Detail pembayaran:\n"
                . "Nomor transaksi: {$orderId}\n"
                . "Status pembayaran: Berhasil\n\n"
                . "Pembayaran Kakak telah tercatat di sistem kami. "
                . "Jika masih terdapat sisa pembayaran, silakan selesaikan sesuai ketentuan pesanan.\n\n"
                . "Terima kasih telah mempercayakan kebutuhan jahit Kakak kepada JAITIN. ✨";

            // Kirim permintaan ke API Fonnte.
            $response = Http::timeout(20)
                ->withHeaders([
                    'Authorization' => $token,
                ])
                ->asForm()
                ->post('https://api.fonnte.com/send', [
                    'target' => $nomor,
                    'message' => $pesan,
                    'countryCode' => '62',
                ]);

            $hasil = $response->json();

            // Catat respons API untuk membantu menemukan penyebab kegagalan.
            Log::info('RESPONS API FONNTE', [
                'order_id' => $orderId,
                'http_status' => $response->status(),
                'response' => $hasil ?? $response->body(),
            ]);

            if (
                !$response->successful() ||
                !is_array($hasil) ||
                ($hasil['status'] ?? false) !== true
            ) {
                Log::warning(
                    'Fonnte gagal menerima permintaan WhatsApp.',
                    ['order_id' => $orderId]
                );

                return;
            }

            Log::info(
                'Fonnte menerima permintaan WhatsApp.',
                ['order_id' => $orderId]
            );

        } catch (Throwable $e) {
            Log::error('Kesalahan saat mengirim WhatsApp.', [
                'order_id' => $orderId,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Kirim ulang WhatsApp untuk transaksi yang sudah berhasil.
     *
     * Fungsi ini bisa dipanggil oleh route internal yang dilindungi
     * middleware autentikasi dan otorisasi admin.
     */
    public function kirimUlangWhatsApp(Request $request, string $orderId)
    {
        $pembayaran = Pembayaran::where(
            'transaksi_id',
            $orderId
        )->first();

        if (!$pembayaran) {
            return response()->json([
                'message' => 'Transaksi tidak ditemukan.',
            ], 404);
        }

        if ($pembayaran->status_pembayaran !== 'Berhasil') {
            return response()->json([
                'message' => 'Pembayaran belum berstatus Berhasil.',
            ], 422);
        }

        $this->kirimWhatsApp($orderId);

        return response()->json([
            'message' => 'Permintaan pengiriman ulang diproses. Periksa log Laravel dan riwayat pesan Fonnte.',
        ], 200);
    }
}