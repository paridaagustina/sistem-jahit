<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganRatingController extends Controller
{
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'ulasan' => ['nullable', 'string', 'max:2000'],
        ]);

        $idUser = Auth::user()->id_user;

        // Pastikan pesanan benar-benar milik pelanggan yang login.
        $pesanan = Pesanan::where('id_pesanan', $id)
            ->where('id_user', $idUser)
            ->firstOrFail();

        // Rating hanya dapat diberikan setelah pesanan diambil.
        if (trim((string) $pesanan->status_pengerjaan) !== 'Sudah Diambil') {
            return back()->with(
                'error',
                'Rating hanya dapat diberikan setelah pesanan berstatus Sudah Diambil.'
            );
        }

        // Satu rating untuk setiap pesanan.
        if (Rating::where('id_pesanan', $pesanan->id_pesanan)->exists()) {
            return back()->with(
                'error',
                'Pesanan ini sudah memiliki rating.'
            );
        }

        Rating::create([
            'id_pesanan' => $pesanan->id_pesanan,
            'id_user' => $idUser,
            'rating' => $validated['rating'],
            'ulasan' => $validated['ulasan'] ?? null,
            'tanggal_rating' => now(),
        ]);

        return redirect()
            ->route('pelanggan.pesanan.index')
            ->with('success', 'Terima kasih! Rating dan ulasan kamu berhasil dikirim.');
    }
}