<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {

            $table->string('model_pakaian')->nullable()->after('jenis_pakaian');

            $table->string('referensi_model')->nullable()->after('model_pakaian');

            $table->text('ukuran')->nullable()->after('referensi_model');

            $table->text('catatan')->nullable()->after('ukuran');

            $table->unsignedBigInteger('id_karyawan')
                ->nullable()
                ->after('id_user');

            $table->decimal('besaran_dp', 15, 2)
                ->nullable()
                ->after('total_harga');

            $table->string('status_pembayaran')
                ->default('Belum Dibayar')
                ->after('besaran_dp');

            $table->string('status_pengerjaan')
                ->default('Menunggu Produksi')
                ->after('status_pembayaran');
        });
    }

    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {

            $table->dropColumn([
                'model_pakaian',
                'referensi_model',
                'ukuran',
                'catatan',
                'id_karyawan',
                'besaran_dp',
                'status_pembayaran',
                'status_pengerjaan',
            ]);
        });
    }
};