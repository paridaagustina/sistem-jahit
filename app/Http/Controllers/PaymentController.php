<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;
use Throwable;

class PaymentController extends Controller
{
    public function pay($id)
    {
        $user = Auth::user();

        // Pastikan pesanan milik pelanggan yang sedang login.
        $pesanan = Pesanan::with('user')
            ->where('id_pesanan', $id)
            ->where('id_user', $user->id_user)
            ->firstOrFail();

        // Tentukan jumlah pembayaran.
        $totalHarga = (float) ($pesanan->total_harga ?? 0);
        $jumlahBayar = (float) ($pesanan->besaran_dp ?? 0);

        if ($jumlahBayar <= 0) {
            $jumlahBayar = $totalHarga;
        }

        if ($jumlahBayar <= 0) {
            return redirect()
                ->route('pelanggan.pesanan.index')
                ->with('error', 'Jumlah pembayaran belum ditentukan.');
        }

        // Konfigurasi Midtrans.
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = (bool) config(
            'services.midtrans.is_production',
            false
        );
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $orderId = 'JTN-' . $pesanan->id_pesanan . '-' . time();

        $customerName = $pesanan->user->name
            ?? $user->name
            ?? 'Pelanggan';

        $customerEmail = $pesanan->user->email
            ?? $user->email
            ?? null;

        $customerPhone = $pesanan->user->no_hp
            ?? $user->no_hp
            ?? null;

        $jenisPembayaran = $jumlahBayar < $totalHarga
            ? 'DP'
            : 'Pelunasan';

        // Siapkan URL tujuan dari route JAITIN yang sudah tersedia.
        $finishUrl = route('pelanggan.pembayaran.index');

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $jumlahBayar,
            ],

            'customer_details' => [
                'first_name' => $customerName,
                'email' => $customerEmail,
                'phone' => $customerPhone,
            ],

            'item_details' => [
                [
                    'id' => 'PESANAN-' . $pesanan->id_pesanan,
                    'price' => (int) $jumlahBayar,
                    'quantity' => 1,
                    'name' => 'Pembayaran Pesanan Jahit #'
                        . $pesanan->id_pesanan,
                ],
            ],

            // Arahkan kembali ke JAITIN setelah pembayaran selesai.
            'callbacks' => [
                'finish' => $finishUrl,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            DB::transaction(function () use (
                $pesanan,
                $orderId,
                $jumlahBayar,
                $jenisPembayaran
            ) {
                Pembayaran::create([
                    'id_pesanan' => $pesanan->id_pesanan,
                    'transaksi_id' => $orderId,
                    'jumlah' => $jumlahBayar,
                    'jenis_pembayaran' => $jenisPembayaran,
                    'tanggal_pembayaran' => now(),
                    'metode_pembayaran' => 'Midtrans',
                    'status_pembayaran' => 'Pending',
                ]);
            });

            return response()
                ->view('pelanggan.pembayaran.bayar', [
                    'pesanan' => $pesanan,
                    'snapToken' => $snapToken,
                    'jumlahBayar' => $jumlahBayar,
                    'orderId' => $orderId,
                    'isProduction' => Config::$isProduction,
                    'clientKey' => config('services.midtrans.client_key'),
                ])
                ->header(
                    'Cache-Control',
                    'no-store, no-cache, must-revalidate, private'
                );

        } catch (Throwable $e) {
            report($e);

            return redirect()
                ->route('pelanggan.pesanan.index')
                ->with(
                    'error',
                    'Gagal membuat pembayaran. Silakan coba kembali.'
                );
        }
    }
}