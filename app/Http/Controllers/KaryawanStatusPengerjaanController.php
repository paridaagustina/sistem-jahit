<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\StatusPengerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class KaryawanStatusPengerjaanController extends Controller
{
    private function daftarStatus(): array
    {
        return [
            'Menunggu Produksi',
            'Sedang Dipotong',
            'Sedang Menjahit',
            'Finishing',
            'Quality Check',
            'Siap Diambil',
            'Sudah Diambil',
        ];
    }

    public function index()
    {
        $pesanan = Pesanan::with('user')
            ->orderByDesc('tanggal_pesan')
            ->get();

        return view('karyawan.pengerjaan.index', compact('pesanan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status_pengerjaan' => [
                'required',
                'string',
                Rule::in($this->daftarStatus()),
            ],
            'estimasi_selesai' => [
                'nullable',
                'date',
            ],
            'keterangan' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $pesanan = Pesanan::findOrFail($id);

        DB::transaction(function () use ($validated, $pesanan) {
            // Perbarui status terbaru pesanan.
            $pesanan->status_pengerjaan =
                $validated['status_pengerjaan'];

            $pesanan->estimasi_selesai =
                $validated['estimasi_selesai'] ?? null;

            $pesanan->save();

            // Simpan riwayat perubahan status.
            StatusPengerjaan::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'id_user' => Auth::id(),
                'status' => $validated['status_pengerjaan'],
                'keterangan' => $validated['keterangan'] ?? null,
                'tanggal_status' => now(),
            ]);
        });

        return redirect()
            ->route('karyawan.pengerjaan.index')
            ->with(
                'success',
                'Status pengerjaan berhasil diperbarui dan riwayat berhasil disimpan.'
            );
    }
}
