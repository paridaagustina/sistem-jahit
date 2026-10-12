
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('referensi_models', function (Blueprint $table) {
            $table->id();
            $table->string('nama_model');
            $table->enum('kategori', [
                'kebaya',
                'dress',
                'perbaikan',
            ]);
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referensi_models');
    }
};
