<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Revisi;
use Illuminate\Support\Facades\Auth;

class KaryawanDashboardController extends Controller
{
    public function index()
    {
        $totalPesanan = Pesanan::count();

        $pesananDiproses = Pesanan::whereIn('status_pengerjaan', [
            'Diproses',
            'Sedang Dijahit',
            'Finishing'
        ])->count();

        $pesananSelesai = Pesanan::whereIn('status_pengerjaan', [
            'Selesai',
            'Siap Diambil'
        ])->count();

        $totalRevisi = Revisi::count();

        $pesananTerbaru = Pesanan::with('user')
            ->orderBy('tanggal_pesan', 'desc')
            ->take(5)
            ->get();

        return view('karyawan.dashboard', compact(
            'totalPesanan',
            'pesananDiproses',
            'pesananSelesai',
            'totalRevisi',
            'pesananTerbaru'
        ));
    }
}