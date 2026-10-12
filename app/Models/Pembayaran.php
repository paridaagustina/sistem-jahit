<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    /**
     * Nama tabel database.
     */
    protected $table = 'pembayaran';

    /**
     * Primary key tabel pembayaran.
     */
    protected $primaryKey = 'id_pembayaran';

    /**
     * Tabel pembayaran tidak menggunakan created_at
     * dan updated_at.
     */
    public $timestamps = false;

    /**
     * Kolom yang boleh diisi melalui mass assignment.
     */
    protected $fillable = [
        'id_pesanan',
        'transaksi_id',
        'jumlah',
        'jenis_pembayaran',
        'tanggal_pembayaran',
        'metode_pembayaran',
        'status_pembayaran',
    ];

    /**
     * Konversi tipe data ketika data diakses.
     */
    protected $casts = [
        'id_pesanan' => 'integer',
        'jumlah' => 'decimal:2',
        'tanggal_pembayaran' => 'datetime',
    ];

    /**
     * Relasi pembayaran dengan pesanan.
     *
     * Satu pembayaran terkait dengan satu pesanan.
     */
    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(
            Pesanan::class,
            'id_pesanan',
            'id_pesanan'
        );
    }
}