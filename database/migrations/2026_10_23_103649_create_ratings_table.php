
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

            // BIGINT UNSIGNED, sesuai dengan tabel pesanan dan users
            $table->foreignId('id_pesanan')
                ->unique()
                ->constrained('pesanan', 'id_pesanan')
                ->cascadeOnDelete();

            $table->foreignId('id_user')
                ->constrained('users', 'id_user')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('rating');
            $table->text('ulasan')->nullable();
            $table->timestamp('tanggal_rating')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
