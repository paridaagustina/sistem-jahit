<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\ReferensiModel;
use App\Services\FonnteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR PESANAN ADMIN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $pesanan = Pesanan::with(['user', 'karyawan'])
            ->orderByDesc('tanggal_pesan')
            ->get();

        return view('admin.pesanan.index', compact('pesanan'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH PESANAN ADMIN
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.pesanan.create');
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN PESANAN ADMIN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, FonnteService $fonnte)
    {
        $validated = $request->validate([
            'id_user' => [
                'required',
                'integer',
                'exists:users,id_user',
            ],
            'id_karyawan' => [
                'nullable',
                'integer',
                'exists:users,id_user',
            ],
            'jenis_pakaian' => [
                'required',
                'string',
                'max:100',
            ],
            'model_pakaian' => [
                'nullable',
                'string',
                'max:255',
            ],
            'referensi_model' => [
                'nullable',
                'string',
                'max:255',
            ],
            'ukuran' => [
                'nullable',
                'string',
            ],
            'catatan' => [
                'nullable',
                'string',
            ],
            'jumlah' => [
                'required',
                'integer',
                'min:1',
            ],
            'tanggal_harapan' => [
                'nullable',
                'date',
            ],
            'estimasi_selesai' => [
                'nullable',
                'date',
            ],
            'status' => [
                'required',
                'string',
                'max:50',
            ],
            'total_harga' => [
                'required',
                'numeric',
                'min:0',
            ],
            'besaran_dp' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'status_pembayaran' => [
                'required',
                'string',
                'max:255',
            ],
            'status_pengerjaan' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $validated['tanggal_pesan'] = now();

        $pesanan = Pesanan::create($validated);
        $pesanan->load('user');

        // Notifikasi pesanan baru kepada pelanggan.
        if ($pesanan->user && $pesanan->user->no_hp) {
            $nama = $pesanan->user->name
                ?? $pesanan->user->nama
                ?? 'Pelanggan';

            $pesan = "Halo, Kak! 👋\n\n"
    . "Terima kasih telah mempercayakan kebutuhan jahit Kakak kepada JAITIN - Toko Jahit Lina.\n\n"
    . "Pesanan Kakak berhasil kami terima dengan detail berikut:\n\n"
    . "Nomor pesanan: #{$pesanan->id_pesanan}\n"
    . "Jenis pakaian: {$pesanan->jenis_pakaian}\n"
    . "Jumlah: {$pesanan->jumlah}\n"
    . "Status pengerjaan: {$pesanan->status_pengerjaan}\n\n"
    . "Tim kami akan melakukan konfirmasi terkait harga dan proses pengerjaan pesanan Kakak.\n\n"
    . "Terima kasih telah memilih JAITIN. 💗";

            $fonnte->send($pesanan->user->no_hp, $pesan);
        }

        return redirect()
            ->route('admin.pesanan.index')
            ->with('success', 'Pesanan berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | FORM EDIT HARGA PESANAN ADMIN
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $pesanan = Pesanan::with(['user', 'karyawan'])
            ->findOrFail($id);

        return view('admin.pesanan.edit', compact('pesanan'));
    }

    /*
    |--------------------------------------------------------------------------
    | PERBARUI HARGA PESANAN ADMIN
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $validated = $request->validate([
            'total_harga' => [
                'required',
                'numeric',
                'min:0',
            ],
        ], [
            'total_harga.required' => 'Total harga wajib diisi.',
            'total_harga.numeric' => 'Total harga harus berupa angka.',
            'total_harga.min' => 'Total harga tidak boleh kurang dari nol.',
        ]);

        $pesanan->total_harga = $validated['total_harga'];
        $pesanan->save();

        return redirect()
            ->route('admin.pesanan.index')
            ->with(
                'success',
                'Total harga pesanan berhasil diperbarui.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS PESANAN ADMIN
    |--------------------------------------------------------------------------
    */

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
    | FORM PESAN JASA JAHIT PELANGGAN
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

    /*
    |--------------------------------------------------------------------------
    | SIMPAN PESANAN PELANGGAN
    |--------------------------------------------------------------------------
    */

    public function storePelanggan(
        Request $request,
        FonnteService $fonnte
    ) {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'pelanggan') {
            abort(403, 'Hanya pelanggan yang dapat membuat pesanan.');
        }

        $validated = $request->validate([
            'jenis_pakaian' => [
                'required',
                'string',
                'max:100',
            ],
            'model_pakaian' => [
                'nullable',
                'string',
                'max:255',
            ],
            'kategori_pilihan' => [
                'nullable',
                'in:kebaya,dress,perbaikan',
            ],
            'referensi_pilihan' => [
                'nullable',
                'integer',
                'exists:referensi_models,id',
            ],
            'model_katalog_id' => [
                'nullable',
                'integer',
                'exists:referensi_models,id',
            ],
            'referensi_model' => [
                'nullable',
                'string',
                'max:255',
            ],
            'referensi_upload' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'ukuran' => [
                'required',
                'string',
            ],
            'catatan' => [
                'nullable',
                'string',
            ],
            'jumlah' => [
                'required',
                'integer',
                'min:1',
            ],
            'tanggal_harapan' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
        ]);

        // Ambil ID model yang dipilih pelanggan.
        $idModel = $request->input('model_katalog_id')
            ?: $request->input('referensi_pilihan');

        $modelTerpilih = null;

        if ($idModel) {
            $modelTerpilih = ReferensiModel::query()
                ->where('id', $idModel)
                ->where('aktif', true)
                ->first();

            if (!$modelTerpilih) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'model_katalog_id' =>
                            'Model tidak tersedia atau sudah tidak aktif. Silakan pilih model lain.',
                    ]);
            }

            $kategoriPilihan = $request->input('kategori_pilihan');

            if (
                $kategoriPilihan &&
                $modelTerpilih->kategori !== $kategoriPilihan
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'model_katalog_id' =>
                            'Model tidak sesuai dengan kategori yang dipilih.',
                    ]);
            }
        }

        // Simpan foto referensi jika pelanggan mengunggahnya.
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

        // Hapus field bantu yang bukan kolom tabel pesanan.
        unset(
            $validated['referensi_upload'],
            $validated['referensi_pilihan'],
            $validated['model_katalog_id'],
            $validated['kategori_pilihan']
        );

        // Isi data pesanan secara otomatis.
        $validated['id_user'] = Auth::user()->id_user;
        $validated['id_karyawan'] = null;
        $validated['tanggal_pesan'] = now();
        $validated['estimasi_selesai'] = null;
        $validated['total_harga'] = 0;
        $validated['besaran_dp'] = 0;
        $validated['status'] = 'Menunggu Diproses';
        $validated['status_pembayaran'] = 'Belum Dibayar';
        $validated['status_pengerjaan'] = 'Menunggu Produksi';

        $pesanan = Pesanan::create($validated);
        $pesanan->load('user');

        // Notifikasi konfirmasi kepada pelanggan.
        if ($pesanan->user && $pesanan->user->no_hp) {
            $nama = $pesanan->user->name
                ?? $pesanan->user->nama
                ?? 'Pelanggan';

            $pesan = "Halo {$nama},\n\n"
                . "Pesanan jahit kamu berhasil dikirim ke JAITIN.\n\n"
                . "Nomor pesanan: #{$pesanan->id_pesanan}\n"
                . "Jenis pakaian: {$pesanan->jenis_pakaian}\n"
                . "Jumlah: {$pesanan->jumlah}\n"
                . "Status: Menunggu Produksi\n\n"
                . "Admin akan mengonfirmasi pesanan dan harga kamu. "
                . "Terima kasih telah menggunakan JAITIN.";

            $fonnte->send($pesanan->user->no_hp, $pesan);
        }

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Pesanan berhasil dikirim. Silakan menunggu konfirmasi dari admin.'
            );
    }
}