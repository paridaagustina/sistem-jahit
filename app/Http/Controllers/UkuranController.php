<?php

namespace App\Http\Controllers;

use App\Models\Ukuran;
use App\Models\User;
use Illuminate\Http\Request;

class UkuranController extends Controller
{
    /**
     * Menampilkan daftar ukuran pelanggan.
     */
    public function index()
    {
        $pelanggan = User::where('role', 'pelanggan')
            ->orderBy('nama', 'asc')
            ->get();

        $ukuran = Ukuran::with('user')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view(
            'karyawan.ukuran.index',
            compact('pelanggan', 'ukuran')
        );
    }

    /**
     * Form tambah ukuran.
     */
    public function create()
    {
        $pelanggan = User::where('role', 'pelanggan')
            ->orderBy('nama', 'asc')
            ->get();

        return view(
            'karyawan.ukuran.create',
            compact('pelanggan')
        );
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
            ->with(
                'success',
                'Data ukuran pelanggan berhasil ditambahkan.'
            );
    }

    /**
     * Form edit ukuran.
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
            'karyawan.ukuran.edit',
            compact('ukuran', 'pelanggan')
        );
    }

    /**
     * Memperbarui ukuran.
     */
    public function update(Request $request, $id)
    {
        $ukuran = Ukuran::where(
            'id_ukuran',
            $id
        )->firstOrFail();

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
            ->route('karyawan.ukuran.index')
            ->with(
                'success',
                'Data ukuran pelanggan berhasil diperbarui.'
            );
    }
}