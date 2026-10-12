<?php

namespace App\Http\Controllers;

use App\Models\Revisi;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevisiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | REVISI PESANAN
    |--------------------------------------------------------------------------
    */


    // =========================
    // TAMPIL RIWAYAT REVISI
    // =========================
    public function index($id)
    {
        // Ambil pesanan
        $pesanan = Pesanan::with([
            'user',
            'revisi.user'
        ])->findOrFail($id);

        // Ambil semua revisi milik pesanan
        $revisi = Revisi::where(
            'id_pesanan',
            $pesanan->id_pesanan
        )
        ->orderBy('tanggal_revisi', 'desc')
        ->get();

        return view(
            'admin.revisi.index',
            compact(
                'pesanan',
                'revisi'
            )
        );
    }


    // =========================
    // FORM TAMBAH REVISI
    // =========================
    public function create($id)
    {
        $pesanan = Pesanan::with('user')
            ->findOrFail($id);

        return view(
            'admin.revisi.create',
            compact('pesanan')
        );
    }


    // =========================
    // SIMPAN REVISI
    // =========================
    public function store(Request $request, $id)
    {
        // Pastikan pesanan tersedia
        $pesanan = Pesanan::findOrFail($id);


        // Validasi
        $validated = $request->validate([

            'keterangan' => [
                'required',
                'string',
            ],

            'tanggal_revisi' => [
                'required',
                'date',
            ],

            'biaya_revisi' => [
                'required',
                'numeric',
                'min:0',
            ],

            'batas_waktu_revisi' => [
                'nullable',
                'date',
            ],
        ]);


        // =========================
        // DATA OTOMATIS
        // =========================

        $validated['id_pesanan'] =
            $pesanan->id_pesanan;

        $validated['id_user'] =
            Auth::user()->id_user;


        // =========================
        // SIMPAN
        // =========================

        Revisi::create($validated);


        // =========================
        // KEMBALI KE RIWAYAT REVISI
        // =========================

        return redirect()
            ->route(
                'admin.revisi.index',
                $pesanan->id_pesanan
            )
            ->with(
                'success',
                'Data revisi berhasil ditambahkan.'
            );
    }


    // =========================
    // FORM EDIT REVISI
    // =========================
    public function edit($id)
    {
        $revisi = Revisi::with([
            'pesanan',
            'user'
        ])->findOrFail($id);

        return view(
            'admin.revisi.edit',
            compact('revisi')
        );
    }


    // =========================
    // UPDATE REVISI
    // =========================
    public function update(Request $request, $id)
    {
        $revisi = Revisi::findOrFail($id);


        // Validasi
        $validated = $request->validate([

            'keterangan' => [
                'required',
                'string',
            ],

            'tanggal_revisi' => [
                'required',
                'date',
            ],

            'biaya_revisi' => [
                'required',
                'numeric',
                'min:0',
            ],

            'batas_waktu_revisi' => [
                'nullable',
                'date',
            ],
        ]);


        // Update revisi
        $revisi->update($validated);


        return redirect()
            ->route(
                'admin.revisi.index',
                $revisi->id_pesanan
            )
            ->with(
                'success',
                'Data revisi berhasil diperbarui.'
            );
    }


    // =========================
    // HAPUS REVISI
    // =========================
    public function destroy($id)
    {
        $revisi = Revisi::findOrFail($id);

        // Simpan ID pesanan sebelum dihapus
        $idPesanan = $revisi->id_pesanan;


        // Hapus revisi
        $revisi->delete();


        return redirect()
            ->route(
                'admin.revisi.index',
                $idPesanan
            )
            ->with(
                'success',
                'Data revisi berhasil dihapus.'
            );
    }
}