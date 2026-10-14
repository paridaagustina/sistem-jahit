<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Ukuran;
use App\Models\User;
use Illuminate\Http\Request;

class UkuranController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DATA UKURAN KARYAWAN
    |--------------------------------------------------------------------------
    */

    /**
     * Menampilkan daftar ukuran pelanggan untuk karyawan.
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
     * Form tambah ukuran oleh karyawan.
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
     * Menyimpan ukuran pelanggan oleh karyawan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'panjang_baju' => 'nullable|numeric|gt:0|max:500',
            'lebar_bahu' => 'nullable|numeric|gt:0|max:200',
            'lingkar_dada' => 'nullable|numeric|gt:0|max:300',
            'lingkar_pinggang' => 'nullable|numeric|gt:0|max:300',
            'lingkar_lengan' => 'nullable|numeric|gt:0|max:200',
            'tanggal' => 'required|date',
        ]);

        if ($this->tidakAdaUkuran($validated)) {
            return back()
                ->withInput()
                ->withErrors([
                    'panjang_baju' => 'Isi minimal satu ukuran tubuh.',
                ]);
        }

        Ukuran::create($validated);

        return redirect()
            ->route('karyawan.ukuran.index')
            ->with(
                'success',
                'Data ukuran pelanggan berhasil ditambahkan.'
            );
    }

    /**
     * Form edit ukuran oleh karyawan.
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
     * Memperbarui ukuran pelanggan oleh karyawan.
     */
    public function update(Request $request, $id)
    {
        $ukuran = Ukuran::where('id_ukuran', $id)
            ->firstOrFail();

        $validated = $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'panjang_baju' => 'nullable|numeric|gt:0|max:500',
            'lebar_bahu' => 'nullable|numeric|gt:0|max:200',
            'lingkar_dada' => 'nullable|numeric|gt:0|max:300',
            'lingkar_pinggang' => 'nullable|numeric|gt:0|max:300',
            'lingkar_lengan' => 'nullable|numeric|gt:0|max:200',
            'tanggal' => 'required|date',
        ]);

        if ($this->tidakAdaUkuran($validated)) {
            return back()
                ->withInput()
                ->withErrors([
                    'panjang_baju' => 'Isi minimal satu ukuran tubuh.',
                ]);
        }

        $ukuran->update($validated);

        return redirect()
            ->route('karyawan.ukuran.index')
            ->with(
                'success',
                'Data ukuran pelanggan berhasil diperbarui.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | UKURAN SAYA - PELANGGAN
    |--------------------------------------------------------------------------
    */

    /**
     * Menampilkan ukuran milik pelanggan yang sedang login.
     */
    public function indexPelanggan()
    {
        $this->pastikanPelanggan();

        $ukuran = Ukuran::where(
            'id_user',
            Auth::user()->id_user
        )
            ->orderBy('tanggal', 'desc')
            ->get();

        return view(
            'pelanggan.ukuran.index',
            compact('ukuran')
        );
    }

    /**
     * Menyimpan ukuran yang diukur sendiri oleh pelanggan.
     */
    public function storePelanggan(Request $request)
    {
        $this->pastikanPelanggan();

        $validated = $request->validate([
            'panjang_baju' => 'nullable|numeric|gt:0|max:500',
            'lebar_bahu' => 'nullable|numeric|gt:0|max:200',
            'lingkar_dada' => 'nullable|numeric|gt:0|max:300',
            'lingkar_pinggang' => 'nullable|numeric|gt:0|max:300',
            'lingkar_lengan' => 'nullable|numeric|gt:0|max:200',
            'tanggal' => 'required|date',
        ]);

        if ($this->tidakAdaUkuran($validated)) {
            return back()
                ->withInput()
                ->withErrors([
                    'panjang_baju' => 'Isi minimal satu ukuran tubuh.',
                ]);
        }

        // ID pelanggan diambil dari akun yang sedang login.
        // Pelanggan tidak bisa menentukan ID pengguna lain.
        $validated['id_user'] = Auth::user()->id_user;

        Ukuran::create($validated);

        return redirect()
            ->route('pelanggan.ukuran.index')
            ->with('success', 'Ukuran berhasil disimpan.');
    }

    /**
     * Memperbarui ukuran milik pelanggan yang sedang login.
     */
    public function updatePelanggan(Request $request, $id)
    {
        $this->pastikanPelanggan();

        // Pastikan ukuran benar-benar milik pelanggan yang login.
        $ukuran = Ukuran::where('id_ukuran', $id)
            ->where('id_user', Auth::user()->id_user)
            ->firstOrFail();

        $validated = $request->validate([
            'panjang_baju' => 'nullable|numeric|gt:0|max:500',
            'lebar_bahu' => 'nullable|numeric|gt:0|max:200',
            'lingkar_dada' => 'nullable|numeric|gt:0|max:300',
            'lingkar_pinggang' => 'nullable|numeric|gt:0|max:300',
            'lingkar_lengan' => 'nullable|numeric|gt:0|max:200',
            'tanggal' => 'required|date',
        ]);

        if ($this->tidakAdaUkuran($validated)) {
            return back()
                ->withInput()
                ->withErrors([
                    'panjang_baju' => 'Isi minimal satu ukuran tubuh.',
                ]);
        }

        // ID pemilik tidak diubah dari data formulir.
        $ukuran->update($validated);

        return redirect()
            ->route('pelanggan.ukuran.index')
            ->with('success', 'Ukuran berhasil diperbarui.');
    }

    /**
     * Menghapus ukuran milik pelanggan yang sedang login.
     */
    public function destroyPelanggan($id)
    {
        $this->pastikanPelanggan();

        $ukuran = Ukuran::where('id_ukuran', $id)
            ->where('id_user', Auth::user()->id_user)
            ->firstOrFail();

        $ukuran->delete();

        return redirect()
            ->route('pelanggan.ukuran.index')
            ->with('success', 'Ukuran berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | METHOD BANTU
    |--------------------------------------------------------------------------
    */

    /**
     * Memastikan fitur pelanggan hanya diakses oleh role pelanggan.
     */
    private function pastikanPelanggan(): void
    {
        abort_unless(
            Auth::check() && Auth::user()->role === 'pelanggan',
            403,
            'Kamu tidak memiliki akses ke halaman ini.'
        );
    }

    /**
     * Memastikan minimal satu ukuran diisi.
     */
    private function tidakAdaUkuran(array $data): bool
    {
        $kolomUkuran = [
            'panjang_baju',
            'lebar_bahu',
            'lingkar_dada',
            'lingkar_pinggang',
            'lingkar_lengan',
        ];

        foreach ($kolomUkuran as $kolom) {
            if (
                isset($data[$kolom]) &&
                $data[$kolom] !== '' &&
                (float) $data[$kolom] > 0
            ) {
                return false;
            }
        }

        return true;
    }
}