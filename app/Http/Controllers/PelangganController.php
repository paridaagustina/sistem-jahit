<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DATA PELANGGAN ADMIN
    |--------------------------------------------------------------------------
    */

    // =========================
    // TAMPIL DATA PELANGGAN
    // =========================
    public function index()
    {
        $pelanggan = User::where('role', 'pelanggan')
            ->orderBy('nama', 'asc')
            ->get();

        return view(
            'admin.pelanggan.index',
            compact('pelanggan')
        );
    }


    // =========================
    // FORM TAMBAH PELANGGAN
    // =========================
    public function create()
    {
        return view('admin.pelanggan.create');
    }


    // =========================
    // SIMPAN PELANGGAN
    // =========================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',

            'email' => [
                'required',
                'email',
                'max:150',
                'unique:users,email',
            ],

            'no_hp' => 'nullable|string|max:20',

            'alamat' => 'nullable|string',

            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ],
        ]);

        // Enkripsi password
        $validated['password'] = bcrypt(
            $validated['password']
        );

        // Otomatis menjadi pelanggan
        $validated['role'] = 'pelanggan';

        // Simpan data pelanggan
        User::create($validated);

        return redirect()
            ->route('admin.pelanggan.index')
            ->with(
                'success',
                'Data pelanggan berhasil ditambahkan.'
            );
    }


    // =========================
    // FORM EDIT PELANGGAN
    // =========================
    public function edit($id)
    {
        $pelanggan = User::where('role', 'pelanggan')
            ->where('id_user', $id)
            ->firstOrFail();

        return view(
            'admin.pelanggan.edit',
            compact('pelanggan')
        );
    }


    // =========================
    // UPDATE PELANGGAN
    // =========================
    public function update(Request $request, $id)
    {
        $pelanggan = User::where('role', 'pelanggan')
            ->where('id_user', $id)
            ->firstOrFail();

        $validated = $request->validate([
            'nama' => 'required|string|max:100',

            'email' => [
                'required',
                'email',
                'max:150',
                'unique:users,email,' . $id . ',id_user',
            ],

            'no_hp' => 'nullable|string|max:20',

            'alamat' => 'nullable|string',

            'password' => [
                'nullable',
                'string',
                'min:6',
                'confirmed',
            ],
        ]);

        // Jika password diisi, update password
        if (!empty($validated['password'])) {

            $validated['password'] = bcrypt(
                $validated['password']
            );

        } else {

            // Jika password kosong, password lama tetap digunakan
            unset($validated['password']);
        }

        // Update data pelanggan
        $pelanggan->update($validated);

        return redirect()
            ->route('admin.pelanggan.index')
            ->with(
                'success',
                'Data pelanggan berhasil diperbarui.'
            );
    }


    // =========================
    // HAPUS PELANGGAN
    // =========================
    public function destroy($id)
    {
        // Cari pelanggan berdasarkan ID
        $pelanggan = User::where('role', 'pelanggan')
            ->where('id_user', $id)
            ->firstOrFail();


        // =========================
        // CEK DATA PESANAN
        // =========================

        $jumlahPesanan = Pesanan::where(
            'id_user',
            $pelanggan->id_user
        )->count();


        // =========================
        // JIKA MASIH ADA PESANAN
        // =========================

        if ($jumlahPesanan > 0) {

            return redirect()
                ->route('admin.pelanggan.index')
                ->with(
                    'error',
                    'Pelanggan tidak dapat dihapus karena masih memiliki ' .
                    $jumlahPesanan .
                    ' data pesanan.'
                );
        }


        // =========================
        // HAPUS PELANGGAN
        // =========================

        $pelanggan->delete();


        // =========================
        // PESAN BERHASIL
        // =========================

        return redirect()
            ->route('admin.pelanggan.index')
            ->with(
                'success',
                'Data pelanggan berhasil dihapus.'
            );
    }
}