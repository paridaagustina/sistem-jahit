<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class PelangganPesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::where(
            'id_user',
            Auth::user()->id_user
        )
        ->orderBy('tanggal_pesan', 'desc')
        ->get();

        return view(
            'pelanggan.pesanan.index',
            compact('pesanan')
        );
    }
}