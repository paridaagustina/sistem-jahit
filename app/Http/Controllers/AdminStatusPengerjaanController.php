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

        // Pencarian berdasarkan ID pesanan atau nama pelanggan
        if ($request->filled('cari')) {
            $cari = trim($request->cari);

            $query->whereHas('pesanan', function ($q) use ($cari) {
                $q->where('id_pesanan', 'like', "%{$cari}%")
                    ->orWhereHas('user', function ($userQuery) use ($cari) {
                        $userQuery->where('nama', 'like', "%{$cari}%");
                    });
            });
        }

        // Filter berdasarkan status pengerjaan
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $statusPengerjaan = $query
            ->orderByDesc('tanggal_status')
            ->orderByDesc('id_status')
            ->paginate(10)
            ->withQueryString();

        // Ringkasan jumlah pesanan berdasarkan status terkini
        $statusTerbaru = StatusPengerjaan::query()
            ->select('id_pesanan')
            ->selectRaw('MAX(id_status) as id_status')
            ->groupBy('id_pesanan');

        $riwayatTerbaru = StatusPengerjaan::query()
            ->joinSub($statusTerbaru, 'terbaru', function ($join) {
                $join->on(
                    'status_pengerjaan.id_status',
                    '=',
                    'terbaru.id_status'
                );
            });

        $totalPesanan = (clone $riwayatTerbaru)
            ->distinct('status_pengerjaan.id_pesanan')
            ->count('status_pengerjaan.id_pesanan');

        $totalMenunggu = (clone $riwayatTerbaru)
            ->whereIn('status_pengerjaan.status', [
                'Menunggu',
                'Menunggu Pengerjaan',
            ])
            ->count();

        $totalProses = (clone $riwayatTerbaru)
            ->whereIn('status_pengerjaan.status', [
                'Sedang Dikerjakan',
                'Dalam Pengerjaan',
                'Proses',
            ])
            ->count();

        $totalSelesai = (clone $riwayatTerbaru)
            ->whereIn('status_pengerjaan.status', [
                'Selesai',
                'Siap Diambil',
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