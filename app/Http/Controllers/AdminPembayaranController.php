<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class AdminPembayaranController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | QUERY DAFTAR PEMBAYARAN
        |--------------------------------------------------------------------------
        | Memuat relasi pesanan dan pelanggan agar nama pelanggan
        | dapat ditampilkan tanpa query berulang.
        */

        $query = Pembayaran::with('pesanan.user');

        // Pencarian berdasarkan ID pesanan atau ID transaksi.
        if ($request->filled('cari')) {
            $cari = trim($request->cari);

            $query->where(function ($q) use ($cari) {
                $q->where('id_pesanan', 'like', "%{$cari}%")
                    ->orWhere('transaksi_id', 'like', "%{$cari}%");
            });
        }

        // Filter status pembayaran.
        if ($request->filled('status')) {
            $query->where(
                'status_pembayaran',
                $request->status
            );
        }

        // Filter jenis pembayaran.
        if ($request->filled('jenis')) {
            $query->where(
                'jenis_pembayaran',
                $request->jenis
            );
        }

        // Daftar pembayaran dengan pagination.
        $pembayaran = $query
            ->orderByDesc('id_pembayaran')
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | RINGKASAN TRANSAKSI
        |--------------------------------------------------------------------------
        | Ringkasan dihitung dari seluruh data, bukan hanya halaman aktif.
        */

        $totalTransaksi = Pembayaran::count();

        // Menghitung status yang umum digunakan payment gateway.
        $statusBerhasil = [
            'berhasil',
            'lunas',
            'success',
            'settlement',
            'capture',
        ];

        $statusMenunggu = [
            'pending',
            'menunggu',
        ];

        $totalBerhasil = Pembayaran::whereIn(
            'status_pembayaran',
            $statusBerhasil
        )->count();

        $totalMenunggu = Pembayaran::whereIn(
            'status_pembayaran',
            $statusMenunggu
        )->count();

        $totalDanaDiterima = Pembayaran::whereIn(
            'status_pembayaran',
            $statusBerhasil
        )->sum('jumlah');

        return view('admin.pembayaran.index', compact(
            'pembayaran',
            'totalTransaksi',
            'totalBerhasil',
            'totalMenunggu',
            'totalDanaDiterima'
        ));
    }
}