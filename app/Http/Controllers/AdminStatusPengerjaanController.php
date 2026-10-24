<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\StatusPengerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminStatusPengerjaanController extends Controller
{
    public function index(Request $request)
    {
        $query = StatusPengerjaan::with([
            'pesanan.user',
            'pesanan.karyawan',
            'user',
        ]);

        if ($request->filled('cari')) {
            $cari = trim($request->input('cari'));

            $query->whereHas('pesanan', function ($q) use ($cari) {
                $q->where('id_pesanan', 'like', "%{$cari}%")
                    ->orWhereHas('user', function ($userQuery) use ($cari) {
                        $userQuery->where('nama', 'like', "%{$cari}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $statusPengerjaan = $query
            ->orderByDesc('tanggal_status')
            ->orderByDesc('id_status')
            ->paginate(10)
            ->withQueryString();

        // Ambil status terakhir dari setiap pesanan yang memiliki riwayat.
        $statusTerbaru = StatusPengerjaan::query()
            ->select('id_pesanan')
            ->selectRaw('MAX(id_status) AS id_status')
            ->groupBy('id_pesanan');

        $riwayatTerbaru = DB::table('status_pengerjaan')
            ->joinSub($statusTerbaru, 'terbaru', function ($join) {
                $join->on(
                    'status_pengerjaan.id_status',
                    '=',
                    'terbaru.id_status'
                );
            });

        $totalPesanan = (clone $riwayatTerbaru)->count();

        $totalMenunggu = (clone $riwayatTerbaru)
            ->whereIn('status_pengerjaan.status', [
                'Menunggu',
                'Menunggu Pengerjaan',
                'Menunggu Produksi',
            ])
            ->count();

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
