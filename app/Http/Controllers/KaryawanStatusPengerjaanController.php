<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\StatusPengerjaan;
use App\Services\FonnteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class KaryawanStatusPengerjaanController extends Controller
{
    private function daftarStatus(): array
    {
        return [
            'Menunggu Produksi',
            'Sedang Dipotong',
            'Sedang Menjahit',
            'Finishing',
            'Quality Check',
            'Siap Diambil',
            'Sudah Diambil',
        ];
    }

    public function index()
    {
        $pesanan = Pesanan::with('user')
            ->orderByDesc('tanggal_pesan')
            ->get();

        return view('karyawan.pengerjaan.index', compact('pesanan'));
    }

    public function update(
        Request $request,
        $id,
        FonnteService $fonnte
    ) {
        $validated = $request->validate([
            'status_pengerjaan' => [
                'required',
                'string',
                Rule::in($this->daftarStatus()),
            ],
            'estimasi_selesai' => [
                'nullable',
                'date',
            ],
            'keterangan' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $pesanan = Pesanan::with('user')->findOrFail($id);

        // Simpan nilai lama sebelum pesanan diperbarui.
        $statusLama = $pesanan->status_pengerjaan;
        $estimasiLama = $pesanan->estimasi_selesai;

        $statusBaru = $validated['status_pengerjaan'];
        $estimasiBaru = $validated['estimasi_selesai'] ?? null;

        $statusBerubah = $statusLama !== $statusBaru;
        $estimasiBerubah = $estimasiLama != $estimasiBaru;

        DB::transaction(function () use (
            $validated,
            $pesanan,
            $statusBaru,
            $estimasiBaru
        ) {
            $pesanan->status_pengerjaan = $statusBaru;
            $pesanan->estimasi_selesai = $estimasiBaru;
            $pesanan->save();

            StatusPengerjaan::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'id_user' => Auth::id(),
                'status' => $statusBaru,
                'keterangan' => $validated['keterangan'] ?? null,
                'tanggal_status' => now(),
            ]);
        });

        // Kirim WhatsApp jika status atau estimasi berubah.
        if ($statusBerubah || $estimasiBerubah) {
            $pelanggan = $pesanan->user;

            if ($pelanggan && !empty($pelanggan->no_hp)) {
                $namaPelanggan = $pelanggan->name
                    ?? $pelanggan->nama
                    ?? 'Pelanggan';

                if ($statusBaru === 'Siap Diambil') {
                    $pesan = "Halo, {$namaPelanggan}! 👋\n\n"
                        . "Ada kabar baik dari JAITIN - Toko Jahit Lina! ✨\n\n"
                        . "Pesanan jahit Kakak telah selesai dan siap diambil.\n\n"
                        . "Nomor pesanan: #{$pesanan->id_pesanan}\n\n"
                        . "Silakan datang ke Toko Jahit Lina untuk mengambil pesanan Kakak. "
                        . "Jika masih ada sisa pembayaran, mohon selesaikan sebelum pengambilan.\n\n"
                        . "Terima kasih telah mempercayakan kebutuhan jahit Kakak kepada JAITIN. 💗";
                } else {
                    $pesan = "Halo, {$namaPelanggan}! 👋\n\n"
                        . "Ada pembaruan pesanan jahit Kakak di JAITIN - Toko Jahit Lina.\n\n"
                        . "Nomor pesanan: #{$pesanan->id_pesanan}\n"
                        . "Status pengerjaan: {$statusBaru}\n";

                    if ($estimasiBerubah) {
                        if (!empty($estimasiBaru)) {
                            $pesan .= "Estimasi selesai: "
                                . \Carbon\Carbon::parse($estimasiBaru)->format('d-m-Y')
                                . "\n";
                        } else {
                            $pesan .= "Estimasi selesai belum ditentukan.\n";
                        }
                    } elseif (!empty($estimasiBaru)) {
                        $pesan .= "Estimasi selesai: "
                            . \Carbon\Carbon::parse($estimasiBaru)->format('d-m-Y')
                            . "\n";
                    }

                    if (!empty($validated['keterangan'])) {
                        $pesan .= "Keterangan: {$validated['keterangan']}\n";
                    }

                    $pesan .= "\nTerima kasih telah mempercayakan kebutuhan jahit Kakak kepada JAITIN. 💗";
                }

                $fonnte->send($pelanggan->no_hp, $pesan);
            }
        }

        return redirect()
            ->route('karyawan.pengerjaan.index')
            ->with(
                'success',
                'Status pengerjaan berhasil diperbarui dan riwayat berhasil disimpan.'
            );
    }
}