<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'karyawan@gmail.com'],
            [
                'nama' => 'Karyawan JAITIN',
                'no_hp' => '081234567890',
                'email' => 'karyawan@gmail.com',
                'password' => Hash::make('Karyawan123!'),
                'role' => 'karyawan',
            ]
        );
    }
}