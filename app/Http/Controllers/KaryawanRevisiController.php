<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Revisi;
use App\Services\FonnteService;
use Illuminate\Http\Request;

class KaryawanRevisiController extends Controller
{
    public function index()
    {
        $revisi = Revisi::with(['pesanan.user'])
            ->orderBy('tanggal_revisi', 'desc')
            ->get();

        return view('karyawan.revisi.index', compact('revisi'));
    }

    public function create()
    {
        $pesanan = Pesanan::with('user')
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        return view('karyawan.revisi.create', compact('pesanan'));
    }

    public function store(Request $request, FonnteService $fonnte)
    {
        $validated = $request->validate([
            'id_pesanan' => 'required|exists:pesanan,id_pesanan',
            'keterangan' => 'required|string',
            'tanggal_revisi' => 'required|date',
            'batas_waktu_revisi' => [
                'required',
                'date',
                'after_or_equal:tanggal_revisi',
            ],
            'biaya_revisi' => 'nullable|numeric|min:0',
        ]);

        $pesanan = Pesanan::with('user')
            ->findOrFail($validated['id_pesanan']);

        $revisi = Revisi::create([
            'id_pesanan' => $pesanan->id_pesanan,
            'id_user' => $pesanan->id_user,
            'keterangan' => $validated['keterangan'],
            'tanggal_revisi' => $validated['tanggal_revisi'],
            'batas_waktu_revisi' => $validated['batas_waktu_revisi'],
            'biaya_revisi' => $validated['biaya_revisi'] ?? 0,
        ]);

        $this->kirimNotifikasiRevisi(
            $fonnte,
            $pesanan,
            $revisi,
            'ditambahkan'
        );

        return redirect()->route('karyawan.revisi.index')
            ->with('success', 'Data revisi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $revisi = Revisi::with(['pesanan.user'])->findOrFail($id);

        $pesanan = Pesanan::with('user')
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        return view('karyawan.revisi.edit', compact('revisi', 'pesanan'));
    }

    public function update(
        Request $request,
        $id,
        FonnteService $fonnte
    ) {
        $validated = $request->validate([
            'id_pesanan' => 'required|exists:pesanan,id_pesanan',
            'keterangan' => 'required|string',
            'tanggal_revisi' => 'required|date',
            'batas_waktu_revisi' => [
                'required',
                'date',
                'after_or_equal:tanggal_revisi',
            ],
            'biaya_revisi' => 'nullable|numeric|min:0',
        ]);

        $pesanan = Pesanan::with('user')
            ->findOrFail($validated['id_pesanan']);

        $revisi = Revisi::findOrFail($id);

        $revisi->update([
            'id_pesanan' => $pesanan->id_pesanan,
            'id_user' => $pesanan->id_user,
            'keterangan' => $validated['keterangan'],
            'tanggal_revisi' => $validated['tanggal_revisi'],
            'batas_waktu_revisi' => $validated['batas_waktu_revisi'],
            'biaya_revisi' => $validated['biaya_revisi'] ?? 0,
        ]);

        $revisi->refresh();

        $this->kirimNotifikasiRevisi(
            $fonnte,
            $pesanan,
            $revisi,
            'diperbarui'
        );

        return redirect()->route('karyawan.revisi.index')
            ->with('success', 'Data revisi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $revisi = Revisi::findOrFail($id);
        $revisi->delete();

        return redirect()->route('karyawan.revisi.index')
            ->with('success', 'Data revisi berhasil dihapus.');
    }

    private function kirimNotifikasiRevisi(
        FonnteService $fonnte,
        Pesanan $pesanan,
        Revisi $revisi,
        string $aksi
    ): void {
        $pelanggan = $pesanan->user;

        if (!$pelanggan || empty($pelanggan->no_hp)) {
            return;
        }

        $biaya = (float) ($revisi->biaya_revisi ?? 0);

        $pesan = "Halo, pelanggan Toko Jahit Lina.\n\n"
            . "Informasi revisi jahitan Anda telah {$aksi}.\n\n"
            . "Nomor Pesanan: #{$pesanan->id_pesanan}\n"
            . "Keterangan Revisi: {$revisi->keterangan}\n"
            . "Tanggal Revisi: {$revisi->tanggal_revisi}\n"
            . "Batas Waktu Revisi: {$revisi->batas_waktu_revisi}\n"
            . "Biaya Revisi: Rp" . number_format($biaya, 0, ',', '.') . "\n\n"
            . "Silakan hubungi Toko Jahit Lina jika ada pertanyaan.\n"
            . "Terima kasih.";

        $berhasil = $fonnte->send($pelanggan->no_hp, $pesan);

\Illuminate\Support\Facades\Log::info(
    'NOTIFIKASI WHATSAPP REVISI',
    [
        'id_pesanan' => $pesanan->id_pesanan,
        'aksi' => $aksi,
        'nomor' => $pelanggan->no_hp,
        'berhasil' => $berhasil,
    ]
);
    }
}