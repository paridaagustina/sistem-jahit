<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\ReferensiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $pesanan = Pesanan::with(['user', 'karyawan'])
            ->orderByDesc('tanggal_pesan')
            ->get();

        return view('admin.pesanan.index', compact('pesanan'));
    }

    public function create()
    {
        return view('admin.pesanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => ['required', 'integer', 'exists:users,id_user'],
            'id_karyawan' => ['nullable', 'integer', 'exists:users,id_user'],
            'jenis_pakaian' => ['required', 'string', 'max:100'],
            'model_pakaian' => ['nullable', 'string', 'max:255'],
            'referensi_model' => ['nullable', 'string', 'max:255'],
            'ukuran' => ['nullable', 'string'],
            'catatan' => ['nullable', 'string'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'tanggal_harapan' => ['nullable', 'date'],
            'estimasi_selesai' => ['nullable', 'date'],
            'status' => ['required', 'string', 'max:50'],
            'total_harga' => ['required', 'numeric', 'min:0'],
            'besaran_dp' => ['nullable', 'numeric', 'min:0'],
            'status_pembayaran' => ['required', 'string', 'max:255'],
            'status_pengerjaan' => ['required', 'string', 'max:255'],
        ]);

        $validated['tanggal_pesan'] = now();

        Pesanan::create($validated);

        return redirect()
            ->route('admin.pesanan.index')
            ->with('success', 'Pesanan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        return view('admin.pesanan.edit', compact('pesanan'));
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $validated = $request->validate([
            'id_user' => ['required', 'integer', 'exists:users,id_user'],
            'id_karyawan' => ['nullable', 'integer', 'exists:users,id_user'],
            'jenis_pakaian' => ['required', 'string', 'max:100'],
            'model_pakaian' => ['nullable', 'string', 'max:255'],
            'referensi_model' => ['nullable', 'string', 'max:255'],
            'ukuran' => ['nullable', 'string'],
            'catatan' => ['nullable', 'string'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'tanggal_harapan' => ['nullable', 'date'],
            'estimasi_selesai' => ['nullable', 'date'],
            'status' => ['required', 'string', 'max:50'],
            'total_harga' => ['required', 'numeric', 'min:0'],
            'besaran_dp' => ['nullable', 'numeric', 'min:0'],
            'status_pembayaran' => ['required', 'string', 'max:255'],
            'status_pengerjaan' => ['required', 'string', 'max:255'],
        ]);

        $pesanan->update($validated);

        return redirect()
            ->route('admin.pesanan.index')
            ->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()
            ->route('admin.pesanan.index')
            ->with('success', 'Pesanan berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | PELANGGAN
    |--------------------------------------------------------------------------
    */

    public function createPelanggan()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'pelanggan') {
            abort(403, 'Halaman ini hanya dapat diakses pelanggan.');
        }

        $referensiModel = ReferensiModel::query()
            ->where('aktif', true)
            ->orderBy('kategori')
            ->orderBy('jenis_model')
            ->orderBy('nama_model')
            ->get();

        return view('pelanggan.pesanan.create', [
            'referensiModel' => $referensiModel,
        ]);
    }

    public function storePelanggan(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'pelanggan') {
            abort(403, 'Hanya pelanggan yang dapat membuat pesanan.');
        }

        $validated = $request->validate([
            'jenis_pakaian' => ['required', 'string', 'max:100'],
            'model_pakaian' => ['nullable', 'string', 'max:255'],
            'kategori_pilihan' => ['nullable', 'in:kebaya,dress,perbaikan'],
            'referensi_pilihan' => ['nullable', 'integer', 'exists:referensi_models,id'],
            'model_katalog_id' => ['nullable', 'integer', 'exists:referensi_models,id'],
            'referensi_model' => ['nullable', 'string', 'max:255'],
            'referensi_upload' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'ukuran' => ['required', 'string'],
            'catatan' => ['nullable', 'string'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'tanggal_harapan' => ['required', 'date', 'after_or_equal:today'],
        ]);

        $idModel = $request->input('model_katalog_id')
            ?: $request->input('referensi_pilihan');

        $modelTerpilih = null;

        if ($idModel) {
            $modelTerpilih = ReferensiModel::query()
                ->where('id', $idModel)
                ->where('aktif', true)
                ->first();

            if (!$modelTerpilih) {
                return back()->withInput()->withErrors([
                    'model_katalog_id' =>
                        'Model tidak tersedia atau sudah tidak aktif. Silakan pilih model lain.',
                ]);
            }

            $kategoriPilihan = $request->input('kategori_pilihan');

            if (
                $kategoriPilihan &&
                $modelTerpilih->kategori !== $kategoriPilihan
            ) {
                return back()->withInput()->withErrors([
                    'model_katalog_id' =>
                        'Model tidak sesuai dengan kategori yang dipilih.',
                ]);
            }
        }

        if ($request->hasFile('referensi_upload')) {
            $pathFoto = $request->file('referensi_upload')
                ->store('referensi-model', 'public');

            $validated['referensi_model'] = $pathFoto;
        } elseif ($modelTerpilih) {
            $validated['referensi_model'] = $modelTerpilih->nama_model;
            $validated['model_pakaian'] = $modelTerpilih->nama_model;
        } else {
            $validated['referensi_model'] = null;
        }

        unset(
            $validated['referensi_upload'],
            $validated['referensi_pilihan'],
            $validated['model_katalog_id'],
            $validated['kategori_pilihan']
        );

        $validated['id_user'] = Auth::user()->id_user;
        $validated['id_karyawan'] = null;
        $validated['tanggal_pesan'] = now();
        $validated['estimasi_selesai'] = null;
        $validated['total_harga'] = 0;
        $validated['besaran_dp'] = 0;
        $validated['status'] = 'Menunggu Diproses';
        $validated['status_pembayaran'] = 'Belum Dibayar';
        $validated['status_pengerjaan'] = 'Menunggu Produksi';

        Pesanan::create($validated);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Pesanan berhasil dikirim. Silakan menunggu konfirmasi dari admin.'
            );
    }
}