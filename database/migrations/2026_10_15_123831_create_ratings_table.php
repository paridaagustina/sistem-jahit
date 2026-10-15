
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id_rating');

            // Menyesuaikan tipe INT pada tabel pesanan dan users
            $table->integer('id_pesanan')->unique();
            $table->integer('id_user');

            $table->unsignedTinyInteger('rating');
            $table->text('ulasan')->nullable();
            $table->timestamp('tanggal_rating')->useCurrent();

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

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
