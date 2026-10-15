<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    protected $table = 'ratings';
    protected $primaryKey = 'id_rating';

    public $timestamps = false;

    protected $fillable = [
        'id_pesanan',
        'id_user',
        'rating',
        'ulasan',
        'tanggal_rating',
    ];

    protected $casts = [
        'rating' => 'integer',
        'tanggal_rating' => 'datetime',
    ];

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(
            Pesanan::class,
            'id_pesanan',
            'id_pesanan'
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }
}