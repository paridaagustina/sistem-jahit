<?php

namespace App\Http\Controllers;

use App\Models\Ukuran;
use Illuminate\Http\Request;

class PelangganUkuranController extends Controller
{
    /**
     * Menampilkan ukuran milik pelanggan yang login.
     */
    public function index()
    {
        $ukuran = Ukuran::where('id_user', auth()->id())
            ->orderByDesc('tanggal')
            ->get();

        return view('pelanggan.ukuran.index', compact('ukuran'));
    }

    /**
     * Menyimpan ukuran baru.
     */
    public function store(Request $request)
    {
        $validated = $this->validateUkuran($request);

        $validated['id_user'] = auth()->id();

        Ukuran::create($validated);

        return redirect()
            ->route('pelanggan.ukuran.index')
            ->with('success', 'Ukuran berhasil disimpan.');
    }

    /**
     * Memperbarui ukuran milik pelanggan.
     */
    public function update(Request $request, $id)
    {
        $ukuran = Ukuran::where('id_user', auth()->id())
            ->where('id_ukuran', $id)
            ->firstOrFail();

        $validated = $this->validateUkuran($request);

        $ukuran->update($validated);

        return redirect()
            ->route('pelanggan.ukuran.index')
            ->with('success', 'Ukuran berhasil diperbarui.');
    }

    /**
     * Menghapus ukuran milik pelanggan.
     */
    public function destroy($id)
    {
        $ukuran = Ukuran::where('id_user', auth()->id())
            ->where('id_ukuran', $id)
            ->firstOrFail();

        $ukuran->delete();

        return redirect()
            ->route('pelanggan.ukuran.index')
            ->with('success', 'Ukuran berhasil dihapus.');
    }

    /**
     * Validasi ukuran tubuh.
     */
    private function validateUkuran(Request $request): array
    {
        $validated = $request->validate([
            'panjang_baju' => 'nullable|numeric|min:0.01|max:500',
            'lebar_bahu' => 'nullable|numeric|min:0.01|max:200',
            'lingkar_dada' => 'nullable|numeric|min:0.01|max:300',
            'lingkar_pinggang' => 'nullable|numeric|min:0.01|max:300',
            'lingkar_lengan' => 'nullable|numeric|min:0.01|max:200',
            'tanggal' => 'required|date',
        ]);

        if (
            collect($validated)
                ->only([
                    'panjang_baju',
                    'lebar_bahu',
                    'lingkar_dada',
                    'lingkar_pinggang',
                    'lingkar_lengan',
                ])
                ->filter(fn ($value) => $value !== null && $value !== '')
                ->isEmpty()
        ) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'panjang_baju' => 'Minimal satu ukuran tubuh harus diisi.',
            ]);
        }

        return $validated;
    }
}
