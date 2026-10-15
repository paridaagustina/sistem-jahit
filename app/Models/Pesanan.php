<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $primaryKey = 'id_pesanan';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_karyawan',
        'jenis_pakaian',
        'model_pakaian',
        'referensi_model',
        'ukuran',
        'catatan',
        'jumlah',
        'tanggal_pesan',
        'tanggal_harapan',
        'estimasi_selesai',
        'status',
        'total_harga',
        'besaran_dp',
        'status_pembayaran',
        'status_pengerjaan',
    ];

    // =========================
    // RELASI KE PELANGGAN
    // =========================
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }

    // =========================
    // RELASI KE KARYAWAN
    // =========================
    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'id_karyawan',
            'id_user'
        );
    }

    // =========================
    // RELASI KE REVISI
    // =========================
    public function revisi(): HasMany
    {
        return $this->hasMany(
            Revisi::class,
            'id_pesanan',
            'id_pesanan'
        );
    }

    // =========================
    // RELASI KE RATING
    // Satu pesanan memiliki maksimal satu rating
    // =========================
    public function rating(): HasOne
    {
        return $this->hasOne(
            Rating::class,
            'id_pesanan',
            'id_pesanan'
        );
    }
}