<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class KaryawanStatusPengerjaanController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with('user')
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        return view(
            'karyawan.pengerjaan.index',
            compact('pesanan')
        );
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status_pengerjaan' => [
                'required',
                'in:Menunggu Produksi,Sedang Dipotong,Sedang Menjahit,Finishing,Quality Check,Siap Diambil,Sudah Diambil'
            ],
            'estimasi_selesai' => 'nullable|date',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        $pesanan->status_pengerjaan = $validated['status_pengerjaan'];
        $pesanan->estimasi_selesai = $validated['estimasi_selesai'] ?? null;

        $pesanan->save();

        return redirect()
            ->route('karyawan.pengerjaan.index')
            ->with(
                'success',
                'Status pengerjaan berhasil diperbarui.'
            );
    }
}