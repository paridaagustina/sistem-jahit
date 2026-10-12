<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Revisi;
use Illuminate\Http\Request;

class KaryawanRevisiController extends Controller
{
    /**
     * Menampilkan seluruh data revisi.
     */
    public function index()
    {
        $revisi = Revisi::with(['pesanan.user'])
            ->orderBy('tanggal_revisi', 'desc')
            ->get();

        return view('karyawan.revisi.index', compact('revisi'));
    }

    /**
     * Menampilkan form tambah revisi.
     */
    public function create()
    {
        $pesanan = Pesanan::with('user')
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        return view('karyawan.revisi.create', compact('pesanan'));
    }

    /**
     * Menyimpan data revisi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pesanan' => 'required|exists:pesanan,id_pesanan',
            'keterangan' => 'required|string',
            'tanggal_revisi' => 'required|date',
            'batas_waktu_revisi' => [
                'required',
                'date',
                'after_or_equal:tanggal_revisi',
            ],
            'biaya_revisi' => 'nullable|numeric|min:0',
        ]);

        $pesanan = Pesanan::findOrFail($validated['id_pesanan']);

        Revisi::create([
            'id_pesanan' => $pesanan->id_pesanan,
            'id_user' => $pesanan->id_user,
            'keterangan' => $validated['keterangan'],
            'tanggal_revisi' => $validated['tanggal_revisi'],
            'batas_waktu_revisi' => $validated['batas_waktu_revisi'],
            'biaya_revisi' => $validated['biaya_revisi'] ?? 0,
        ]);

        return redirect()
            ->route('karyawan.revisi.index')
            ->with('success', 'Data revisi berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit revisi.
     */
    public function edit($id)
    {
        $revisi = Revisi::with(['pesanan.user'])
            ->findOrFail($id);

        $pesanan = Pesanan::with('user')
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        return view(
            'karyawan.revisi.edit',
            compact('revisi', 'pesanan')
        );
    }

    /**
     * Memperbarui data revisi.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_pesanan' => 'required|exists:pesanan,id_pesanan',
            'keterangan' => 'required|string',
            'tanggal_revisi' => 'required|date',
            'batas_waktu_revisi' => [
                'required',
                'date',
                'after_or_equal:tanggal_revisi',
            ],
            'biaya_revisi' => 'nullable|numeric|min:0',
        ]);

        $pesanan = Pesanan::findOrFail($validated['id_pesanan']);
        $revisi = Revisi::findOrFail($id);

        $revisi->update([
            'id_pesanan' => $pesanan->id_pesanan,
            'id_user' => $pesanan->id_user,
            'keterangan' => $validated['keterangan'],
            'tanggal_revisi' => $validated['tanggal_revisi'],
            'batas_waktu_revisi' => $validated['batas_waktu_revisi'],
            'biaya_revisi' => $validated['biaya_revisi'] ?? 0,
        ]);

        return redirect()
            ->route('karyawan.revisi.index')
            ->with('success', 'Data revisi berhasil diperbarui.');
    }

    /**
     * Menghapus data revisi.
     */
    public function destroy($id)
    {
        $revisi = Revisi::findOrFail($id);
        $revisi->delete();

        return redirect()
            ->route('karyawan.revisi.index')
            ->with('success', 'Data revisi berhasil dihapus.');
    }
}