<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('status_pengerjaan', function (Blueprint $table) {
            $table->id('id_status');

            $table->unsignedBigInteger('id_pesanan');
            $table->unsignedBigInteger('id_user')->nullable();

            $table->string('status');
            $table->text('keterangan')->nullable();
            $table->timestamp('tanggal_status')->useCurrent();

            $table->foreign('id_pesanan')
                ->references('id_pesanan')
                ->on('pesanan')
                ->cascadeOnDelete();

            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('status_pengerjaan');
    }
};
