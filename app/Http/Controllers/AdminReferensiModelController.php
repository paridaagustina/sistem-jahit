<?php

namespace App\Http\Controllers;

use App\Models\ReferensiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminReferensiModelController extends Controller
{
    /**
     * Menampilkan halaman utama Referensi Model.
     */
    public function index()
    {
        $referensiModels = ReferensiModel::latest()->get();

        // Daftar jenis model yang tersedia pada setiap kategori.
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

        return view('admin.referensi-model.index', [
            'referensiModels' => $referensiModels,
            'jenisModel' => $jenisModel,
        ]);
    }

    /**
     * Menampilkan galeri berdasarkan kategori utama.
     */
    public function kategori(string $kategori)
    {
        $kategoriDiizinkan = [
            'kebaya',
            'dress',
            'perbaikan',
        ];

        abort_unless(
            in_array($kategori, $kategoriDiizinkan, true),
            404
        );

        $referensiModels = ReferensiModel::where('kategori', $kategori)
            ->where('aktif', true)
            ->latest()
            ->get();

        return view('admin.referensi-model.kategori', [
            'kategori' => $kategori,
            'referensiModels' => $referensiModels,
        ]);
    }

    /**
     * Menampilkan galeri foto untuk satu jenis model.
     */
    public function jenis(string $kategori, string $jenis)
    {
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

        abort_unless(
            isset($jenisModel[$kategori][$jenis]),
            404
        );

        $namaJenis = $jenisModel[$kategori][$jenis];

        $referensiModels = ReferensiModel::where('kategori', $kategori)
            ->where('jenis_model', $namaJenis)
            ->where('aktif', true)
            ->latest()
            ->get();

        return view('admin.referensi-model.jenis', [
            'kategori' => $kategori,
            'jenis' => $jenis,
            'namaJenis' => $namaJenis,
            'referensiModels' => $referensiModels,
        ]);
    }

    /**
     * Menyimpan referensi model baru beserta foto.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_model' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'in:kebaya,dress,perbaikan'],
            'jenis_model' => ['required', 'string', 'max:100'],
            'deskripsi' => ['nullable', 'string'],
            'foto' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'aktif' => ['nullable', 'boolean'],
        ]);

        // Pastikan jenis model sesuai dengan kategori yang dipilih.
        $jenisModel = [
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

        if (! in_array(
            $validated['jenis_model'],
            $jenisModel[$validated['kategori']],
            true
        )) {
            return back()
                ->withErrors([
                    'jenis_model' => 'Jenis model tidak sesuai dengan kategori.',
                ])
                ->withInput();
        }

        $validated['foto'] = $request->file('foto')
            ->store('referensi-model', 'public');

        $validated['aktif'] = $request->boolean('aktif');

        ReferensiModel::create($validated);

        return redirect()
            ->route('admin.referensi-model.index')
            ->with('success', 'Referensi model berhasil ditambahkan.');
    }

    /**
     * Memperbarui referensi model.
     */
    public function update(Request $request, ReferensiModel $referensiModel)
    {
        $validated = $request->validate([
            'nama_model' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'in:kebaya,dress,perbaikan'],
            'jenis_model' => ['required', 'string', 'max:100'],
            'deskripsi' => ['nullable', 'string'],
            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'aktif' => ['nullable', 'boolean'],
        ]);

        $jenisModel = [
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

        if (! in_array(
            $validated['jenis_model'],
            $jenisModel[$validated['kategori']],
            true
        )) {
            return back()
                ->withErrors([
                    'jenis_model' => 'Jenis model tidak sesuai dengan kategori.',
                ])
                ->withInput();
        }

        if ($request->hasFile('foto')) {
            if ($referensiModel->foto) {
                Storage::disk('public')->delete($referensiModel->foto);
            }

            $validated['foto'] = $request->file('foto')
                ->store('referensi-model', 'public');
        }

        $validated['aktif'] = $request->boolean('aktif');

        $referensiModel->update($validated);

        return redirect()
            ->route('admin.referensi-model.index')
            ->with('success', 'Referensi model berhasil diperbarui.');
    }

    /**
     * Menghapus referensi model dan fotonya.
     */
    public function destroy(ReferensiModel $referensiModel)
    {
        if ($referensiModel->foto) {
            Storage::disk('public')->delete($referensiModel->foto);
        }

        $referensiModel->delete();

        return redirect()
            ->route('admin.referensi-model.index')
            ->with('success', 'Referensi model berhasil dihapus.');
    }
}