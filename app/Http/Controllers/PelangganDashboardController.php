<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PelangganDashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id_user;

        // Ambil pesanan milik pelanggan yang sedang login.
        $pesanan = Pesanan::where('id_user', $userId);

        // Pesanan yang belum selesai, belum diambil, dan tidak dibatalkan.
        $pesananAktif = (clone $pesanan)
            ->whereNotIn('status_pengerjaan', [
                'selesai',
                'diambil',
                'dibatalkan',
                'ditolak',
            ])
            ->count();

        // Pesanan yang masih menunggu pembayaran.
        $menungguPembayaran = (clone $pesanan)
            ->whereIn('status_pembayaran', [
                'belum dibayar',
                'menunggu pembayaran',
                'pending',
            ])
            ->count();

        // Pesanan yang sudah selesai dijahit dan siap diambil.
        $siapDiambil = (clone $pesanan)
            ->whereIn('status_pengerjaan', [
                'siap diambil',
                'siap diambil pelanggan',
            ])
            ->count();

        return view('pelanggan.dashboard', compact(
            'pesananAktif',
            'menungguPembayaran',
            'siapDiambil'
        ));
    }
}
