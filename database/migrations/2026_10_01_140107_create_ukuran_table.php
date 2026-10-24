<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('ukuran')) {
            Schema::create('ukuran', function (Blueprint $table) {
                $table->id('id_ukuran');

                $table->unsignedBigInteger('id_user');

                $table->decimal('panjang_baju', 8, 2)->nullable();
                $table->decimal('lebar_bahu', 8, 2)->nullable();
                $table->decimal('lingkar_dada', 8, 2)->nullable();
                $table->decimal('lingkar_pinggang', 8, 2)->nullable();
                $table->decimal('lingkar_lengan', 8, 2)->nullable();

                $table->date('tanggal');

                $table->foreign('id_user')
                    ->references('id_user')
                    ->on('users')
                    ->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ukuran');
    }
};