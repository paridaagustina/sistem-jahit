<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('revisi')) {
            Schema::create('revisi', function (Blueprint $table) {
                $table->bigIncrements('id_revisi');

                $table->unsignedBigInteger('id_pesanan');
                $table->unsignedBigInteger('id_user');

                $table->text('keterangan');
                $table->dateTime('tanggal_revisi');
                $table->decimal('biaya_revisi', 12, 2)->default(0);
                $table->date('batas_waktu_revisi')->nullable();

                $table->foreign('id_pesanan')
                    ->references('id_pesanan')
                    ->on('pesanan')
                    ->cascadeOnDelete();

                $table->foreign('id_user')
                    ->references('id_user')
                    ->on('users')
                    ->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('revisi');
    }
};
