<?php

namespace App\Http\Controllers;

use App\Models\ReferensiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminReferensiModelController extends Controller
{
    /**
     * Daftar jenis model untuk setiap kategori.
     * Alias digunakan agar data lama tetap dapat ditampilkan.
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
     * Mengambil daftar nama jenis model yang diizinkan
     * berdasarkan kategori.
     */
    private function jenisYangDiizinkan(): array
    {
        $hasil = [];

        foreach ($this->daftarJenisModel() as $kategori => $jenis) {
            foreach ($jenis as $dataJenis) {
                $hasil[$kategori] = array_merge(
                    $hasil[$kategori] ?? [],
                    $dataJenis['alias']
                );
            }

            $hasil[$kategori] = array_values(
                array_unique($hasil[$kategori] ?? [])
            );
        }

        return $hasil;
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
     * Aturan validasi untuk menyimpan dan memperbarui referensi.
     */
    private function aturanValidasi(bool $fotoWajib): array
    {
        return [
            'nama_model' => [
                'required',
                'string',
                'max:255',
            ],

            'kategori' => [
                'required',
                Rule::in(array_keys($this->daftarJenisModel())),
            ],

            'jenis_model' => [
                'required',
                'string',
                'max:100',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'foto' => [
                $fotoWajib ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'aktif' => [
                'sometimes',
                'boolean',
            ],
        ];
    }

    /**
     * Menampilkan halaman utama Referensi Model.
     */
    public function index()
    {
        $referensiModels = ReferensiModel::latest()->get();

        $jenisModel = [];

        foreach ($this->daftarJenisModel() as $kategori => $jenis) {
            foreach ($jenis as $slug => $dataJenis) {
                $jenisModel[$kategori][$slug] = $dataJenis['nama'];
            }
        }

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
     * Menampilkan galeri referensi berdasarkan jenis model.
     * Data dengan nama jenis lama tetap ditampilkan melalui alias.
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

        $referensiModels = ReferensiModel::where('kategori', $kategori)
            ->whereIn('jenis_model', $aliasJenis)
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
     * Memvalidasi bahwa jenis model sesuai dengan kategori.
     */
    private function validasiJenisModel(
        string $kategori,
        string $jenisModel
    ): void {
        if (! $this->jenisSesuaiKategori($kategori, $jenisModel)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'jenis_model' => 'Jenis model tidak sesuai dengan kategori yang dipilih.',
            ]);
        }
    }

    /**
     * Menyimpan referensi model baru beserta foto.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->aturanValidasi(true)
        );

        $this->validasiJenisModel(
            $validated['kategori'],
            $validated['jenis_model']
        );

        $fotoBaru = $request->file('foto')
            ->store('referensi-model', 'public');

        $validated['foto'] = $fotoBaru;
        $validated['aktif'] = $request->boolean('aktif');

        try {
            ReferensiModel::create($validated);
        } catch (\Throwable $e) {
            Storage::disk('public')->delete($fotoBaru);

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

        // Hapus foto lama hanya setelah pembaruan berhasil.
        if ($fotoBaru && $fotoLama) {
            Storage::disk('public')->delete($fotoLama);
        }

        return redirect()
            ->route('admin.referensi-model.index')
            ->with('success', 'Referensi model berhasil diperbarui.');
    }

    /**
     * Menghapus referensi model beserta fotonya.
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