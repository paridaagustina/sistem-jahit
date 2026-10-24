<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel pembayaran.
     */
    public function up(): void
    {
        if (!Schema::hasTable('pembayaran')) {
            Schema::create('pembayaran', function (Blueprint $table) {
                $table->id('id_pembayaran');

                $table->unsignedBigInteger('id_pesanan');

                $table->string('transaksi_id', 100)->nullable();

                $table->decimal('jumlah', 12, 2);

                $table->string('jenis_pembayaran', 50);

                $table->dateTime('tanggal_pembayaran');

                $table->string('metode_pembayaran', 50);

                $table->string('status_pembayaran', 50);

                $table->foreign('id_pesanan')
                    ->references('id_pesanan')
                    ->on('pesanan')
                    ->cascadeOnDelete();
            });
        }
    }

    /**
     * Menghapus tabel pembayaran.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};