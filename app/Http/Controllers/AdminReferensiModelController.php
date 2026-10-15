<?php

namespace App\Http\Controllers;

use App\Models\ReferensiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminReferensiModelController extends Controller
{
    /**
     * Daftar jenis model untuk setiap kategori.
     */
    private function daftarJenisModel(): array
    {
        return [
            'kebaya' => [
                'kebaya-klasik' => [
                    'nama' => 'Kebaya Klasik',
                    'alias' => ['Kebaya Klasik'],
                ],
                'kebaya-modern' => [
                    'nama' => 'Kebaya Modern',
                    'alias' => ['Kebaya Modern'],
                ],
                'kebaya-minimalis' => [
                    'nama' => 'Kebaya Minimalis',
                    'alias' => ['Kebaya Minimalis'],
                ],
            ],

            'dress' => [
                'dress-pesta' => [
                    'nama' => 'Dress Pesta',
                    'alias' => ['Dress Pesta'],
                ],
                'dress-formal' => [
                    'nama' => 'Dress Formal',
                    'alias' => ['Dress Formal'],
                ],
                'dress-casual' => [
                    'nama' => 'Dress Casual',
                    'alias' => ['Dress Casual'],
                ],
            ],

            'perbaikan' => [
                'perbaikan-kerusakan-robekan' => [
                    'nama' => 'Perbaikan Kerusakan & Robekan (Mending)',
                    'alias' => [
                        'Perbaikan Kerusakan & Robekan (Mending)',
                        'Memperbaiki Jahitan',
                    ],
                ],

                'penyesuaian-ukuran-model' => [
                    'nama' => 'Penyesuaian Ukuran & Model (Alteration / Vermak)',
                    'alias' => [
                        'Penyesuaian Ukuran & Model (Alteration / Vermak)',
                        'Mengecilkan Pakaian',
                        'Memendekkan Pakaian',
                        'Mengganti Resleting',
                        'Mengecilkan Ukuran',
                        'Memperbesar Ukuran',
                    ],
                ],
            ],
        ];
    }

    /**
     * Daftar jenis yang boleh dipilih saat menambah atau mengubah data.
     */
    private function jenisYangDiizinkan(): array
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
                'Perbaikan Kerusakan & Robekan (Mending)',
                'Penyesuaian Ukuran & Model (Alteration / Vermak)',
                // Nama lama tetap diterima agar data lama tidak terhambat.
                'Memperbaiki Jahitan',
                'Mengecilkan Pakaian',
                'Memendekkan Pakaian',
                'Mengganti Resleting',
                'Mengecilkan Ukuran',
                'Memperbesar Ukuran',
            ],
        ];
    }

    /**
     * Memeriksa apakah jenis model sesuai dengan kategori.
     */
    private function jenisSesuaiKategori(
        string $kategori,
        string $jenisModel
    ): bool {
        $daftarJenis = $this->jenisYangDiizinkan();

        return isset($daftarJenis[$kategori])
            && in_array($jenisModel, $daftarJenis[$kategori], true);
    }

    /**
     * Menampilkan halaman utama Referensi Model.
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
                'perbaikan-kerusakan-robekan'
                    => 'Perbaikan Kerusakan & Robekan (Mending)',

                'penyesuaian-ukuran-model'
                    => 'Penyesuaian Ukuran & Model (Alteration / Vermak)',
            ],
        ];

        return view('admin.referensi-model.index', [
            'referensiModels' => $referensiModels,
            'jenisModel' => $jenisModel,
        ]);
    }

    /**
     * Menampilkan halaman kategori utama.
     */
    public function kategori(string $kategori)
    {
        abort_unless(
            in_array($kategori, ['kebaya', 'dress', 'perbaikan'], true),
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
     * Menampilkan galeri foto berdasarkan jenis model.
     */
    public function jenis(string $kategori, string $jenis)
    {
        $daftarJenis = $this->daftarJenisModel();

        abort_unless(
            isset($daftarJenis[$kategori][$jenis]),
            404
        );

        $dataJenis = $daftarJenis[$kategori][$jenis];

        $namaJenis = $dataJenis['nama'];
        $aliasJenis = $dataJenis['alias'];

        /*
         * Menggunakan whereIn agar referensi yang masih memakai nama
         * jenis lama tetap muncul pada kelompok layanan yang sesuai.
         */
        $referensiModels = ReferensiModel::where('kategori', $kategori)
            ->whereIn('jenis_model', $aliasJenis)
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

        if (! $this->jenisSesuaiKategori(
            $validated['kategori'],
            $validated['jenis_model']
        )) {
            return back()
                ->withErrors([
                    'jenis_model' => 'Jenis model tidak sesuai dengan kategori yang dipilih.',
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
    public function update(
        Request $request,
        ReferensiModel $referensiModel
    ) {
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

        if (! $this->jenisSesuaiKategori(
            $validated['kategori'],
            $validated['jenis_model']
        )) {
            return back()
                ->withErrors([
                    'jenis_model' => 'Jenis model tidak sesuai dengan kategori yang dipilih.',
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
     * Menghapus referensi model beserta fotonya.
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