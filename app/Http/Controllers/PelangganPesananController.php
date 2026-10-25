<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class PelangganPesananController extends Controller
{
    public function index()
    {
        $idUser = Auth::user()->id_user;

        $pesanan = Pesanan::with('rating')
            ->where('id_user', $idUser)
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        return view(
            'pelanggan.pesanan.index',
            compact('pesanan')
        );
    }
}