<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ukuran extends Model
{
    protected $table = 'ukuran';

    protected $primaryKey = 'id_ukuran';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'panjang_baju',
        'lebar_bahu',
        'lingkar_dada',
        'lingkar_pinggang',
        'lingkar_lengan',
        'tanggal',
    ];

    protected $casts = [
        'panjang_baju' => 'decimal:2',
        'lebar_bahu' => 'decimal:2',
        'lingkar_dada' => 'decimal:2',
        'lingkar_pinggang' => 'decimal:2',
        'lingkar_lengan' => 'decimal:2',
        'tanggal' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }
}