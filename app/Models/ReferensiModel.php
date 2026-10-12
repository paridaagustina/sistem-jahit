<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferensiModel extends Model
{
    protected $table = 'referensi_models';

    protected $fillable = [
        'nama_model',
        'kategori',
        'jenis_model',
        'deskripsi',
        'foto',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'aktif' => 'boolean',
        ];
    }
}