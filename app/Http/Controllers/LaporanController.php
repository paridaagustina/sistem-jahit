<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LAPORAN ADMIN
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        // Ambil filter dari form
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;
        $status = $request->status;

        // Query pesanan
        $query = Pesanan::with('user')
            ->orderBy('tanggal_pesan', 'desc');

        // Filter tanggal mulai
        if ($tanggalMulai) {
            $query->whereDate(
                'tanggal_pesan',
                '>=',
                $tanggalMulai
            );
        }

        // Filter tanggal selesai
        if ($tanggalSelesai) {
            $query->whereDate(
                'tanggal_pesan',
                '<=',
                $tanggalSelesai
            );
        }

        // Filter status
        if ($status) {
            $query->where(
                'status',
                $status
            );
        }

        // Ambil data
        $pesanan = $query->get();

        // Statistik laporan
        $jumlahPesanan = $pesanan->count();

        $totalHarga = $pesanan->sum(
            'total_harga'
        );

        $totalDp = $pesanan->sum(
            'besaran_dp'
        );

        return view(
            'admin.laporan.index',
            compact(
                'pesanan',
                'jumlahPesanan',
                'totalHarga',
                'totalDp',
                'tanggalMulai',
                'tanggalSelesai',
                'status'
            )
        );
    }
}