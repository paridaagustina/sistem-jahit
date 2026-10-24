<?php

namespace App\Http\Controllers;

use App\Models\ReferensiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminReferensiModelController extends Controller
{
    /**
     * Daftar kategori dan jenis model yang diizinkan.
     */
    private function daftarJenisModel(): array
    {
        return [
            'kebaya' => [
                'Kebaya Klasik',
                'Kebaya Modern',
                'Kebaya Minimalis',
            ],
            'dress' => [
                'Dress Pesta',
                'Dress Formal',
                'Dress Casual',
            ],
            'perbaikan' => [
                'Mengecilkan Pakaian',
                'Memendekkan Pakaian',
                'Mengganti Resleting',
            ],
        ];
    }

    /**
     * Menampilkan halaman utama referensi model.
     */
    public function index()
    {
        $referensiModels = ReferensiModel::latest()->get();

        $jenisModel = [
            'kebaya' => [
                'kebaya-klasik' => 'Kebaya Klasik',
                'kebaya-modern' => 'Kebaya Modern',
                'kebaya-minimalis' => 'Kebaya Minimalis',
            ],
            'dress' => [
                'dress-pesta' => 'Dress Pesta',
                'dress-formal' => 'Dress Formal',
                'dress-casual' => 'Dress Casual',
            ],
            'perbaikan' => [
                'mengecilkan-pakaian' => 'Mengecilkan Pakaian',
                'memendekkan-pakaian' => 'Memendekkan Pakaian',
                'ganti-resleting' => 'Mengganti Resleting',
            ],
        ];

        return view('admin.referensi-model.index', compact(
            'referensiModels',
            'jenisModel'
        ));
    }

    /**
     * Menampilkan referensi berdasarkan kategori.
     */
    public function kategori(string $kategori)
    {
        abort_unless(
            array_key_exists($kategori, $this->daftarJenisModel()),
            404
        );

        $referensiModels = ReferensiModel::where('kategori', $kategori)
            ->where('aktif', true)
            ->latest()
            ->get();

        return view('admin.referensi-model.kategori', compact(
            'kategori',
            'referensiModels'
        ));
    }

    /**
     * Menampilkan referensi berdasarkan jenis model.
     */
    public function jenis(string $kategori, string $jenis)
    {
        $daftarJenis = [
            'kebaya' => [
                'kebaya-klasik' => 'Kebaya Klasik',
                'kebaya-modern' => 'Kebaya Modern',
                'kebaya-minimalis' => 'Kebaya Minimalis',
            ],
            'dress' => [
                'dress-pesta' => 'Dress Pesta',
                'dress-formal' => 'Dress Formal',
                'dress-casual' => 'Dress Casual',
            ],
            'perbaikan' => [
                'mengecilkan-pakaian' => 'Mengecilkan Pakaian',
                'memendekkan-pakaian' => 'Memendekkan Pakaian',
                'ganti-resleting' => 'Mengganti Resleting',
            ],
        ];

        abort_unless(isset($daftarJenis[$kategori][$jenis]), 404);

        $namaJenis = $daftarJenis[$kategori][$jenis];

        $referensiModels = ReferensiModel::where('kategori', $kategori)
            ->where('jenis_model', $namaJenis)
            ->where('aktif', true)
            ->latest()
            ->get();

        return view('admin.referensi-model.jenis', compact(
            'kategori',
            'jenis',
            'namaJenis',
            'referensiModels'
        ));
    }

    /**
     * Aturan validasi bersama untuk menyimpan dan memperbarui data.
     */
    private function aturanValidasi(bool $fotoWajib): array
    {
        return [
            'nama_model' => ['required', 'string', 'max:255'],
            'kategori' => [
                'required',
                Rule::in(array_keys($this->daftarJenisModel())),
            ],
            'jenis_model' => ['required', 'string', 'max:100'],
            'deskripsi' => ['nullable', 'string'],
            'foto' => array_filter([
                $fotoWajib ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ]),
            'aktif' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * Memastikan jenis model cocok dengan kategori.
     */
    private function validasiJenisModel(
        Request $request,
        string $kategori,
        string $jenisModel
    ): void {
        $daftarJenis = $this->daftarJenisModel();

        if (
            ! isset($daftarJenis[$kategori]) ||
            ! in_array($jenisModel, $daftarJenis[$kategori], true)
        ) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'jenis_model' => 'Jenis model tidak sesuai dengan kategori yang dipilih.',
            ]);
        }
    }

    /**
     * Menyimpan referensi model baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->aturanValidasi(true)
        );

        $this->validasiJenisModel(
            $request,
            $validated['kategori'],
            $validated['jenis_model']
        );

        $validated['foto'] = $request->file('foto')
            ->store('referensi-model', 'public');

        $validated['aktif'] = $request->boolean('aktif');

        try {
            ReferensiModel::create($validated);
        } catch (\Throwable $e) {
            Storage::disk('public')->delete($validated['foto']);

            throw $e;
        }

        return redirect()
            ->route('admin.referensi-model.index')
            ->with('success', 'Referensi model berhasil ditambahkan.');
    }

    /**
     * Memperbarui referensi model.
     */
    public function update(
        Request $request,
        ReferensiModel $referensiModel
    ) {
        $validated = $request->validate(
            $this->aturanValidasi(false)
        );

        $this->validasiJenisModel(
            $request,
            $validated['kategori'],
            $validated['jenis_model']
        );

        $fotoLama = $referensiModel->foto;
        $fotoBaru = null;

        if ($request->hasFile('foto')) {
            $fotoBaru = $request->file('foto')
                ->store('referensi-model', 'public');

            $validated['foto'] = $fotoBaru;
        }

        $validated['aktif'] = $request->boolean('aktif');

        try {
            $referensiModel->update($validated);
        } catch (\Throwable $e) {
            if ($fotoBaru) {
                Storage::disk('public')->delete($fotoBaru);
            }

            throw $e;
        }

        if ($fotoBaru && $fotoLama) {
            Storage::disk('public')->delete($fotoLama);
        }

        return redirect()
            ->route('admin.referensi-model.index')
            ->with('success', 'Referensi model berhasil diperbarui.');
    }

    /**
     * Menghapus referensi model.
     */
    public function destroy(ReferensiModel $referensiModel)
    {
        $foto = $referensiModel->foto;

        $referensiModel->delete();

        if ($foto) {
            Storage::disk('public')->delete($foto);
        }

        return redirect()
            ->route('admin.referensi-model.index')
            ->with('success', 'Referensi model berhasil dihapus.');
    }
}
