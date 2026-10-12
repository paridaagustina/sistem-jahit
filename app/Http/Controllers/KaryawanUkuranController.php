<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ukuran;
use Illuminate\Http\Request;

class KaryawanUkuranController extends Controller
{
    /**
     * Menampilkan daftar ukuran pelanggan.
     */
    public function index()
    {
        $ukuran = Ukuran::with('user')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('karyawan.ukuran.index', compact('ukuran'));
    }

    /**
     * Menampilkan form tambah ukuran.
     */
    public function create()
    {
        $pelanggan = User::where('role', 'pelanggan')
            ->orderBy('nama')
            ->get();

        return view('karyawan.ukuran.create', compact('pelanggan'));
    }

    /**
     * Menyimpan ukuran baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'panjang_baju' => 'nullable|numeric|min:0',
            'lebar_bahu' => 'nullable|numeric|min:0',
            'lingkar_dada' => 'nullable|numeric|min:0',
            'lingkar_pinggang' => 'nullable|numeric|min:0',
            'lingkar_lengan' => 'nullable|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        Ukuran::create($validated);

        return redirect()
            ->route('karyawan.ukuran.index')
            ->with('success', 'Ukuran pelanggan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit ukuran.
     */
    public function edit($id)
    {
        $ukuran = Ukuran::findOrFail($id);

        $pelanggan = User::where('role', 'pelanggan')
            ->orderBy('nama')
            ->get();

        return view(
            'karyawan.ukuran.edit',
            compact('ukuran', 'pelanggan')
        );
    }

    /**
     * Memperbarui ukuran pelanggan.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'panjang_baju' => 'nullable|numeric|min:0',
            'lebar_bahu' => 'nullable|numeric|min:0',
            'lingkar_dada' => 'nullable|numeric|min:0',
            'lingkar_pinggang' => 'nullable|numeric|min:0',
            'lingkar_lengan' => 'nullable|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        $ukuran = Ukuran::findOrFail($id);
        $ukuran->update($validated);

        return redirect()
            ->route('karyawan.ukuran.index')
            ->with('success', 'Ukuran pelanggan berhasil diperbarui.');
    }
}