<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->bigIncrements('id_pesanan');

            $table->unsignedBigInteger('id_user');
            $table->string('jenis_pakaian');
            $table->unsignedInteger('jumlah')->default(1);

            $table->date('tanggal_pesan')->nullable();
            $table->date('tanggal_harapan')->nullable();
            $table->date('estimasi_selesai')->nullable();

            $table->string('status')->default('Menunggu');
            $table->decimal('total_harga', 15, 2)->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};