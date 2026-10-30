<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    /**
     * Mengirim pesan WhatsApp melalui Fonnte.
     */
    public function send(string $nomor, string $pesan): bool
    {
        $token = config('services.fonnte.token');

        if (empty($token)) {
            Log::error('Fonnte gagal: token belum dikonfigurasi.');
            return false;
        }

        $nomor = $this->formatNomor($nomor);

        if ($nomor === '') {
            Log::warning('Fonnte gagal: nomor WhatsApp kosong atau tidak valid.');
            return false;
        }

        try {
            $response = Http::timeout(15)
                ->withHeaders([
                    'Authorization' => $token,
                ])
                ->asForm()
                ->post('https://api.fonnte.com/send', [
                    'target' => $nomor,
                    'message' => $pesan,
                    'countryCode' => '62',
                ]);

            $hasil = $response->json();

            if (
                $response->successful()
                && is_array($hasil)
                && ($hasil['status'] ?? false) === true
            ) {
                Log::info('Permintaan WhatsApp Fonnte berhasil.', [
                    'nomor' => $nomor,
                ]);

                return true;
            }

            Log::warning('Fonnte menolak permintaan WhatsApp.', [
                'http_status' => $response->status(),
                'response' => $hasil ?? $response->body(),
            ]);

            return false;
        } catch (\Throwable $e) {
            Log::error('Kesalahan saat menghubungi Fonnte.', [
                'message' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * Mengubah nomor Indonesia menjadi format internasional.
     */
    private function formatNomor(string $nomor): string
    {
        $nomor = preg_replace('/[\s\-().+]/', '', trim($nomor)) ?? '';

        if (str_starts_with($nomor, '0')) {
            $nomor = '62' . substr($nomor, 1);
        } elseif (str_starts_with($nomor, '8')) {
            $nomor = '62' . $nomor;
        }

        // Pastikan hanya angka dan panjangnya masuk akal.
        if (!preg_match('/^62[0-9]{8,13}$/', $nomor)) {
            return '';
        }

        return $nomor;
    }
}