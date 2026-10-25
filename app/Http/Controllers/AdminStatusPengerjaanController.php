<?php

namespace App\Http\Controllers;

use App\Models\StatusPengerjaan;
use Illuminate\Http\Request;

class AdminStatusPengerjaanController extends Controller
{
    public function index(Request $request)
    {
        $query = StatusPengerjaan::with([
            'pesanan.user',
            'pesanan.karyawan',
            'user',
        ]);

        // Pencarian berdasarkan ID pesanan atau nama pelanggan.
        if ($request->filled('cari')) {
            $cari = trim($request->input('cari'));

            $query->whereHas('pesanan', function ($q) use ($cari) {
                $q->where('id_pesanan', 'like', "%{$cari}%")
                    ->orWhereHas('user', function ($userQuery) use ($cari) {
                        $userQuery->where('nama', 'like', "%{$cari}%");
                    });
            });
        }

        // Filter berdasarkan status pengerjaan.
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $statusPengerjaan = $query
            ->orderByDesc('tanggal_status')
            ->orderByDesc('id_status')
            ->paginate(10)
            ->withQueryString();

        /*
         * Mengambil satu riwayat status terbaru untuk setiap pesanan.
         */
        $statusTerbaru = StatusPengerjaan::query()
            ->select('id_pesanan')
            ->selectRaw('MAX(id_status) AS id_status')
            ->groupBy('id_pesanan');

        $riwayatTerbaru = StatusPengerjaan::query()
            ->joinSub($statusTerbaru, 'terbaru', function ($join) {
                $join->on(
                    'status_pengerjaan.id_status',
                    '=',
                    'terbaru.id_status'
                );
            });

        // Total pesanan yang memiliki riwayat status.
        $totalPesanan = (clone $riwayatTerbaru)
            ->distinct('status_pengerjaan.id_pesanan')
            ->count('status_pengerjaan.id_pesanan');

        // Pesanan yang masih menunggu.
        $totalMenunggu = (clone $riwayatTerbaru)
            ->whereIn('status_pengerjaan.status', [
                'Menunggu',
                'Menunggu Pengerjaan',
                'Menunggu Produksi',
            ])
            ->count();

        // Pesanan yang sedang dikerjakan.
        $totalProses = (clone $riwayatTerbaru)
            ->whereIn('status_pengerjaan.status', [
                'Sedang Dikerjakan',
                'Dalam Pengerjaan',
                'Proses',
                'Sedang Dipotong',
                'Sedang Menjahit',
                'Finishing',
                'Quality Check',
            ])
            ->count();

        // Pesanan yang sudah selesai.
        $totalSelesai = (clone $riwayatTerbaru)
            ->whereIn('status_pengerjaan.status', [
                'Selesai',
                'Siap Diambil',
                'Sudah Diambil',
            ])
            ->count();

        return view('admin.status-pengerjaan.index', compact(
            'statusPengerjaan',
            'totalPesanan',
            'totalMenunggu',
            'totalProses',
            'totalSelesai'
        ));
    }
}
