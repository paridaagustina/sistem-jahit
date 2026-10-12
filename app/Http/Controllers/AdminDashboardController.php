<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $jumlahPelanggan = User::where('role', 'pelanggan')->count();

        $jumlahPesanan = Pesanan::count();

        $pesananDiproses = Pesanan::whereIn('status', [
            'Diproses',
            'Sedang Dikerjakan',
            'Dalam Pengerjaan'
        ])->count();

        $pesananSelesai = Pesanan::where('status', 'Selesai')->count();

        return view('admin.dashboard', compact(
            'jumlahPelanggan',
            'jumlahPesanan',
            'pesananDiproses',
            'pesananSelesai'
        ));
    }
}