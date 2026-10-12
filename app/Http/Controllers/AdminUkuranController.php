<?php

namespace App\Http\Controllers;

use App\Models\Ukuran;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUkuranController extends Controller
{
    /**
     * Menampilkan seluruh data ukuran pelanggan.
     */
    public function index()
    {
        $ukuran = Ukuran::with('user')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.ukuran.index', compact('ukuran'));
    }

    /**
     * Menampilkan formulir tambah ukuran.
     */
    public function create()
    {
        $pelanggan = User::where('role', 'pelanggan')
            ->orderBy('nama', 'asc')
            ->get();

        return view('admin.ukuran.create', compact('pelanggan'));
    }

    /**
     * Menyimpan data ukuran baru.
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
            ->route('admin.ukuran.index')
            ->with('success', 'Data ukuran berhasil ditambahkan.');
    }

    /**
     * Menampilkan formulir edit ukuran.
     */
    public function edit($id)
    {
        $ukuran = Ukuran::with('user')
            ->where('id_ukuran', $id)
            ->firstOrFail();

        $pelanggan = User::where('role', 'pelanggan')
            ->orderBy('nama', 'asc')
            ->get();

        return view(
            'admin.ukuran.edit',
            compact('ukuran', 'pelanggan')
        );
    }

    /**
     * Memperbarui data ukuran.
     */
    public function update(Request $request, $id)
    {
        $ukuran = Ukuran::where('id_ukuran', $id)
            ->firstOrFail();

        $validated = $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'panjang_baju' => 'nullable|numeric|min:0',
            'lebar_bahu' => 'nullable|numeric|min:0',
            'lingkar_dada' => 'nullable|numeric|min:0',
            'lingkar_pinggang' => 'nullable|numeric|min:0',
            'lingkar_lengan' => 'nullable|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        $ukuran->update($validated);

        return redirect()
            ->route('admin.ukuran.index')
            ->with('success', 'Data ukuran berhasil diperbarui.');
    }

    /**
     * Menghapus data ukuran.
     */
    public function destroy($id)
    {
        $ukuran = Ukuran::where('id_ukuran', $id)
            ->firstOrFail();

        $ukuran->delete();

        return redirect()
            ->route('admin.ukuran.index')
            ->with('success', 'Data ukuran berhasil dihapus.');
    }
}