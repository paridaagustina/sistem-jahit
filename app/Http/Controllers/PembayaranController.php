<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    // =========================
    // TAMPIL DATA PEMBAYARAN ADMIN
    // =========================
    public function index()
    {
        $pembayaran = Pembayaran::with('pesanan.user')
            ->orderBy('tanggal_pembayaran', 'desc')
            ->get();

        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    // =========================
    // FORM TAMBAH PEMBAYARAN ADMIN
    // =========================
    public function create()
    {
        $pesanan = Pesanan::with('user')
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        return view('admin.pembayaran.create', compact('pesanan'));
    }

    // =========================
    // SIMPAN PEMBAYARAN ADMIN
    // =========================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pesanan' => 'required|exists:pesanan,id_pesanan',
            'transaksi_id' => 'nullable|string|max:100',
            'jumlah' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'required|string|max:50',
            'tanggal_pembayaran' => 'required|date',
            'metode_pembayaran' => 'required|string|max:50',
            'status_pembayaran' => 'required|string|max:50',
        ]);

        Pembayaran::create($validated);

        return redirect()
            ->route('admin.pembayaran.index')
            ->with('success', 'Data pembayaran berhasil ditambahkan.');
    }

    // =========================
    // FORM EDIT PEMBAYARAN ADMIN
    // =========================
    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pesanan = Pesanan::with('user')
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        return view(
            'admin.pembayaran.edit',
            compact('pembayaran', 'pesanan')
        );
    }

    // =========================
    // UPDATE PEMBAYARAN ADMIN
    // =========================
    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $validated = $request->validate([
            'id_pesanan' => 'required|exists:pesanan,id_pesanan',
            'transaksi_id' => 'nullable|string|max:100',
            'jumlah' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'required|string|max:50',
            'tanggal_pembayaran' => 'required|date',
            'metode_pembayaran' => 'required|string|max:50',
            'status_pembayaran' => 'required|string|max:50',
        ]);

        $pembayaran->update($validated);

        return redirect()
            ->route('admin.pembayaran.index')
            ->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    // =========================
    // HAPUS PEMBAYARAN ADMIN
    // =========================
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()
            ->route('admin.pembayaran.index')
            ->with('success', 'Data pembayaran berhasil dihapus.');
    }

    // =========================
    // RIWAYAT PEMBAYARAN PELANGGAN
    // =========================
    public function riwayatPelanggan()
    {
        $idUser = Auth::user()->id_user;

        $pembayaran = Pembayaran::with('pesanan')
            ->whereHas('pesanan', function ($query) use ($idUser) {
                $query->where('id_user', $idUser);
            })
            ->orderBy('tanggal_pembayaran', 'desc')
            ->get();

        return view(
            'pelanggan.pembayaran.index',
            compact('pembayaran')
        );
    }
}