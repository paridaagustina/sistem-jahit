
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('referensi_models', function (Blueprint $table) {
            $table->string('jenis_model')
                ->nullable()
                ->after('kategori');
        });
    }

    public function down(): void
    {
        Schema::table('referensi_models', function (Blueprint $table) {
            $table->dropColumn('jenis_model');
        });
    }
};
