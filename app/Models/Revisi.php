<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Revisi extends Model
{
    protected $table = 'revisi';

    protected $primaryKey = 'id_revisi';

    public $timestamps = false;

    protected $fillable = [
        'id_pesanan',
        'id_user',
        'keterangan',
        'tanggal_revisi',
        'biaya_revisi',
        'batas_waktu_revisi',
    ];

    protected $casts = [
        'tanggal_revisi' => 'datetime',
        'batas_waktu_revisi' => 'date',
        'biaya_revisi' => 'decimal:2',
    ];

    public function pesanan()
    {
        return $this->belongsTo(
            Pesanan::class,
            'id_pesanan',
            'id_pesanan'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }
}