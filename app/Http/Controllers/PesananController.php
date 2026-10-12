<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\User;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    // =========================
    // DATA PESANAN ADMIN
    // =========================
    public function index()
    {
        $pesanan = Pesanan::with(['user', 'karyawan'])
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        return view(
            'admin.pesanan.index',
            compact('pesanan')
        );
    }


    // =========================
    // FORM TAMBAH PESANAN ADMIN
    // =========================
    public function create()
    {
        $pelanggan = User::where('role', 'pelanggan')
            ->orderBy('nama', 'asc')
            ->get();

        $karyawan = User::where('role', 'karyawan')
            ->orderBy('nama', 'asc')
            ->get();

        return view(
            'admin.pesanan.create',
            compact('pelanggan', 'karyawan')
        );
    }


    // =========================
    // SIMPAN PESANAN ADMIN
    // =========================
    public function store(Request $request)
    {
        $validated = $request->validate([

            'id_user' => [
                'required',
                'exists:users,id_user',
            ],

            'id_karyawan' => [
                'nullable',
                'exists:users,id_user',
            ],

            'jenis_pakaian' => 'required|string|max:100',

            'model_pakaian' => 'nullable|string|max:255',

            'referensi_model' => 'nullable|string|max:255',

            'ukuran' => 'nullable|string',

            'catatan' => 'nullable|string',

            'jumlah' => 'required|integer|min:1',

            'tanggal_pesan' => 'required|date',

            'tanggal_harapan' => 'nullable|date',

            'estimasi_selesai' => 'nullable|date',

            'status' => 'required|string|max:50',

            'total_harga' => 'required|numeric|min:0',

            'besaran_dp' => 'nullable|numeric|min:0',

            'status_pembayaran' => 'nullable|string|max:50',

            'status_pengerjaan' => 'nullable|string|max:50',
        ]);


        // =========================
        // NILAI DEFAULT
        // =========================

        $validated['besaran_dp'] =
            $validated['besaran_dp'] ?? 0;

        $validated['status_pembayaran'] =
            $validated['status_pembayaran']
            ?? 'Belum Dibayar';

        $validated['status_pengerjaan'] =
            $validated['status_pengerjaan']
            ?? 'Menunggu Produksi';


        // =========================
        // SIMPAN PESANAN
        // =========================

        Pesanan::create($validated);


        return redirect()
            ->route('admin.pesanan.index')
            ->with(
                'success',
                'Pesanan berhasil ditambahkan.'
            );
    }


    // =========================
    // FORM EDIT PESANAN ADMIN
    // =========================
    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $pelanggan = User::where('role', 'pelanggan')
            ->orderBy('nama', 'asc')
            ->get();

        $karyawan = User::where('role', 'karyawan')
            ->orderBy('nama', 'asc')
            ->get();

        return view(
            'admin.pesanan.edit',
            compact(
                'pesanan',
                'pelanggan',
                'karyawan'
            )
        );
    }


    // =========================
    // UPDATE PESANAN ADMIN
    // =========================
    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $validated = $request->validate([

            'id_user' => [
                'required',
                'exists:users,id_user',
            ],

            'id_karyawan' => [
                'nullable',
                'exists:users,id_user',
            ],

            'jenis_pakaian' => 'required|string|max:100',

            'model_pakaian' => 'nullable|string|max:255',

            'referensi_model' => 'nullable|string|max:255',

            'ukuran' => 'nullable|string',

            'catatan' => 'nullable|string',

            'jumlah' => 'required|integer|min:1',

            'tanggal_pesan' => 'required|date',

            'tanggal_harapan' => 'nullable|date',

            'estimasi_selesai' => 'nullable|date',

            'status' => 'required|string|max:50',

            'total_harga' => 'required|numeric|min:0',

            'besaran_dp' => 'nullable|numeric|min:0',

            'status_pembayaran' => 'nullable|string|max:50',

            'status_pengerjaan' => 'nullable|string|max:50',
        ]);


        // =========================
        // NILAI DEFAULT
        // =========================

        $validated['besaran_dp'] =
            $validated['besaran_dp'] ?? 0;

        $validated['status_pembayaran'] =
            $validated['status_pembayaran']
            ?? 'Belum Dibayar';

        $validated['status_pengerjaan'] =
            $validated['status_pengerjaan']
            ?? 'Menunggu Produksi';


        // =========================
        // UPDATE PESANAN
        // =========================

        $pesanan->update($validated);


        return redirect()
            ->route('admin.pesanan.index')
            ->with(
                'success',
                'Pesanan berhasil diperbarui.'
            );
    }


    // =========================
    // HAPUS PESANAN ADMIN
    // =========================
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);


        // ==================================================
        // 1. CEK APAKAH MASIH MEMILIKI DATA PEMBAYARAN
        // ==================================================

        $jumlahPembayaran = Pembayaran::where(
            'id_pesanan',
            $pesanan->id_pesanan
        )->count();


        if ($jumlahPembayaran > 0) {

            return redirect()
                ->route('admin.pesanan.index')
                ->with(
                    'error',
                    'Pesanan tidak dapat dihapus karena sudah memiliki data pembayaran.'
                );
        }


        // ==================================================
        // 2. CEK STATUS PESANAN
        // ==================================================

        $status = strtolower(
            trim($pesanan->status ?? '')
        );

        $statusPengerjaan = strtolower(
            trim($pesanan->status_pengerjaan ?? '')
        );


        // Status yang masih boleh dianggap dalam proses
        $statusTidakBolehHapus = [

            'dibuat',

            'menunggu',

            'menunggu diproses',

            'diproses',

            'sedang dikerjakan',

            'dalam pengerjaan',

            'menunggu produksi',

        ];


        // ==================================================
        // 3. JIKA MASIH DALAM PROSES
        // ==================================================

        if (
            in_array($status, $statusTidakBolehHapus) ||
            in_array($statusPengerjaan, $statusTidakBolehHapus)
        ) {

            return redirect()
                ->route('admin.pesanan.index')
                ->with(
                    'error',
                    'Pesanan tidak dapat dihapus karena masih dalam proses pengerjaan.'
                );
        }


        // ==================================================
        // 4. HAPUS PESANAN
        // ==================================================

        try {

            $pesanan->delete();

        } catch (\Illuminate\Database\QueryException $e) {

            return redirect()
                ->route('admin.pesanan.index')
                ->with(
                    'error',
                    'Pesanan tidak dapat dihapus karena masih memiliki data yang berhubungan.'
                );
        }


        // ==================================================
        // 5. BERHASIL
        // ==================================================

        return redirect()
            ->route('admin.pesanan.index')
            ->with(
                'success',
                'Pesanan berhasil dihapus.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | PELANGGAN
    |--------------------------------------------------------------------------
    */

    // =========================
    // FORM PEMESANAN PELANGGAN
    // =========================
    public function createPelanggan()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'pelanggan') {
            abort(403);
        }

        return view(
            'pelanggan.pesanan.create'
        );
    }


    // =========================
    // SIMPAN PESANAN PELANGGAN
    // =========================
    public function storePelanggan(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'pelanggan') {
            abort(403);
        }


        $validated = $request->validate([

            'jenis_pakaian' => 'required|string|max:100',

            'model_pakaian' => 'nullable|string|max:255',

            'referensi_model' => 'nullable|string|max:255',

            'referensi_upload' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'ukuran' => 'required|string',

            'catatan' => 'nullable|string',

            'jumlah' => 'required|integer|min:1',

            'tanggal_harapan' => 'required|date',
        ]);


        // =========================
        // UPLOAD REFERENSI MODEL
        // =========================

        if ($request->hasFile('referensi_upload')) {

            $path = $request
                ->file('referensi_upload')
                ->store(
                    'referensi-model',
                    'public'
                );

            $validated['referensi_model'] = $path;
        }


        // =========================
        // DATA OTOMATIS
        // =========================

        $validated['id_user'] =
            Auth::user()->id_user;

        $validated['id_karyawan'] = null;

        $validated['tanggal_pesan'] = now();

        $validated['estimasi_selesai'] = null;

        $validated['total_harga'] = 0;

        $validated['besaran_dp'] = 0;

        $validated['status'] =
            'Menunggu Diproses';

        $validated['status_pembayaran'] =
            'Belum Dibayar';

        $validated['status_pengerjaan'] =
            'Menunggu Produksi';


        // Field upload tidak disimpan
        unset(
            $validated['referensi_upload']
        );


        // =========================
        // SIMPAN PESANAN
        // =========================

        Pesanan::create($validated);


        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Pesanan berhasil dikirim. Silakan menunggu konfirmasi dari admin.'
            );
    }
}