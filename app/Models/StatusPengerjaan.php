<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StatusPengerjaan extends Model
{
    protected $table = 'status_pengerjaan';

    protected $primaryKey = 'id_status';

    public $timestamps = false;

    protected $fillable = [
        'id_pesanan',
        'id_user',
        'status',
        'keterangan',
        'tanggal_status',
    ];

    protected $casts = [
        'tanggal_status' => 'datetime',
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