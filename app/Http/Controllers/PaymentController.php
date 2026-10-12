<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function pay($id)
    {
        $pesanan = Pesanan::with('user')->findOrFail($id);

        $jumlahBayar = $pesanan->besaran_dp ?? 0;

        if ($jumlahBayar <= 0) {
            $jumlahBayar = $pesanan->total_harga;
        }

        if ($jumlahBayar <= 0) {
            return redirect()
                ->route('admin.pesanan.index')
                ->with('error', 'Jumlah pembayaran belum ditentukan.');
        }

        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $orderId = 'JTN-' . $pesanan->id_pesanan . '-' . time();

        $customerName = $pesanan->user->nama ?? 'Pelanggan';
        $customerEmail = $pesanan->user->email ?? null;
        $customerPhone = $pesanan->user->no_hp ?? null;

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
                    'name' => 'Pembayaran Pesanan Jahit #' . $pesanan->id_pesanan,
                ],
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            Pembayaran::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'transaksi_id' => $orderId,
                'jumlah' => $jumlahBayar,
                'jenis_pembayaran' => ($jumlahBayar < $pesanan->total_harga)
                    ? 'DP'
                    : 'Pelunasan',
                'tanggal_pembayaran' => now(),
                'metode_pembayaran' => 'Midtrans',
                'status_pembayaran' => 'Pending',
            ]);

            return view('admin.pembayaran.bayar', compact(
                'pesanan',
                'snapToken',
                'jumlahBayar',
                'orderId'
            ));

        } catch (\Exception $e) {

            return redirect()
                ->route('admin.pesanan.index')
                ->with('error', 'Gagal membuat pembayaran: ' . $e->getMessage());
        }
    }
}