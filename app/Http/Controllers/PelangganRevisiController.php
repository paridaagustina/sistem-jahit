<?php

namespace App\Http\Controllers;

use App\Models\Revisi;
use Illuminate\Support\Facades\Auth;

class PelangganRevisiController extends Controller
{
    public function index()
    {
        $idUser = Auth::user()->id_user;

        $revisi = Revisi::with('pesanan')
            ->where('id_user', $idUser)
            ->orderBy('tanggal_revisi', 'desc')
            ->get();

        return view('pelanggan.revisi.index', compact('revisi'));
    }
}