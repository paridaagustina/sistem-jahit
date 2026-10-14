
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\KaryawanDashboardController;

use App\Http\Controllers\PesananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganPesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\AdminPembayaranController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RevisiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UkuranController;

use App\Http\Controllers\KaryawanRevisiController;
use App\Http\Controllers\KaryawanStatusPengerjaanController;

use App\Http\Controllers\AdminUkuranController;
use App\Http\Controllers\AdminReferensiModelController;
use App\Http\Controllers\AdminStatusPengerjaanController;

/*
|--------------------------------------------------------------------------
| AUTENTIKASI
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| ROUTE YANG MEMBUTUHKAN LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/dashboard', [
        AdminDashboardController::class, 'index'
    ])->name('admin.dashboard');

    Route::get('/dashboard', function () {
        return view('pelanggan.dashboard');
    })->name('dashboard');

    Route::get('/karyawan/dashboard', [
        KaryawanDashboardController::class, 'index'
    ])->name('karyawan.dashboard');


    /*
    |--------------------------------------------------------------------------
    | PESANAN ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/pesanan', [
        PesananController::class, 'index'
    ])->name('admin.pesanan.index');

    Route::get('/admin/pesanan/create', [
        PesananController::class, 'create'
    ])->name('admin.pesanan.create');

    Route::post('/admin/pesanan', [
        PesananController::class, 'store'
    ])->name('admin.pesanan.store');

    Route::get('/admin/pesanan/{id}/edit', [
        PesananController::class, 'edit'
    ])->name('admin.pesanan.edit');

    Route::put('/admin/pesanan/{id}', [
        PesananController::class, 'update'
    ])->name('admin.pesanan.update');

    Route::delete('/admin/pesanan/{id}', [
        PesananController::class, 'destroy'
    ])->name('admin.pesanan.destroy');


    /*
    |--------------------------------------------------------------------------
    | PESAN JASA JAHIT PELANGGAN
    |--------------------------------------------------------------------------
    */

    Route::get('/pesan-jasa-jahit', [
        PesananController::class, 'createPelanggan'
    ])->name('pelanggan.pesanan.create');

    Route::post('/pesan-jasa-jahit', [
        PesananController::class, 'storePelanggan'
    ])->name('pelanggan.pesanan.store');


    /*
    |--------------------------------------------------------------------------
    | PESANAN SAYA PELANGGAN
    |--------------------------------------------------------------------------
    */

    Route::get('/pesanan-saya', [
        PelangganPesananController::class, 'index'
    ])->name('pelanggan.pesanan.index');


    /*
    |--------------------------------------------------------------------------
    | PEMBAYARAN PELANGGAN
    |--------------------------------------------------------------------------
    */

    Route::get('/pesanan-saya/{id}/bayar', [
        PaymentController::class, 'pay'
    ])->name('pelanggan.pembayaran.pay');


    /*
    |--------------------------------------------------------------------------
    | DATA PELANGGAN ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/pelanggan', [
        PelangganController::class, 'index'
    ])->name('admin.pelanggan.index');

    Route::get('/admin/pelanggan/create', [
        PelangganController::class, 'create'
    ])->name('admin.pelanggan.create');

    Route::post('/admin/pelanggan', [
        PelangganController::class, 'store'
    ])->name('admin.pelanggan.store');

    Route::get('/admin/pelanggan/{id}/edit', [
        PelangganController::class, 'edit'
    ])->name('admin.pelanggan.edit');

    Route::put('/admin/pelanggan/{id}', [
        PelangganController::class, 'update'
    ])->name('admin.pelanggan.update');

    Route::delete('/admin/pelanggan/{id}', [
        PelangganController::class, 'destroy'
    ])->name('admin.pelanggan.destroy');


    /*
    |--------------------------------------------------------------------------
    | REVISI PESANAN ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/pesanan/{id}/revisi', [
        RevisiController::class, 'index'
    ])->name('admin.revisi.index');

    Route::get('/admin/pesanan/{id}/revisi/create', [
        RevisiController::class, 'create'
    ])->name('admin.revisi.create');

    Route::post('/admin/pesanan/{id}/revisi', [
        RevisiController::class, 'store'
    ])->name('admin.revisi.store');

    Route::get('/admin/revisi/{id}/edit', [
        RevisiController::class, 'edit'
    ])->name('admin.revisi.edit');

    Route::put('/admin/revisi/{id}', [
        RevisiController::class, 'update'
    ])->name('admin.revisi.update');

    Route::delete('/admin/revisi/{id}', [
        RevisiController::class, 'destroy'
    ])->name('admin.revisi.destroy');


    /*
    |--------------------------------------------------------------------------
    | LAPORAN ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/laporan', [
        LaporanController::class, 'index'
    ])->name('admin.laporan.index');


    /*
    |--------------------------------------------------------------------------
    | PEMBAYARAN ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/pembayaran', [
        AdminPembayaranController::class, 'index'
    ])->name('admin.pembayaran.index');


    /*
    |--------------------------------------------------------------------------
    | UKURAN KARYAWAN
    |--------------------------------------------------------------------------
    */

    Route::get('/karyawan/ukuran', [
        UkuranController::class, 'index'
    ])->name('karyawan.ukuran.index');

    Route::get('/karyawan/ukuran/create', [
        UkuranController::class, 'create'
    ])->name('karyawan.ukuran.create');

    Route::post('/karyawan/ukuran', [
        UkuranController::class, 'store'
    ])->name('karyawan.ukuran.store');

    Route::get('/karyawan/ukuran/{id}/edit', [
        UkuranController::class, 'edit'
    ])->name('karyawan.ukuran.edit');

    Route::put('/karyawan/ukuran/{id}', [
        UkuranController::class, 'update'
    ])->name('karyawan.ukuran.update');


    /*
    |--------------------------------------------------------------------------
    | REVISI KARYAWAN
    |--------------------------------------------------------------------------
    */

    Route::get('/karyawan/revisi', [
        KaryawanRevisiController::class, 'index'
    ])->name('karyawan.revisi.index');

    Route::get('/karyawan/revisi/create', [
        KaryawanRevisiController::class, 'create'
    ])->name('karyawan.revisi.create');

    Route::post('/karyawan/revisi', [
        KaryawanRevisiController::class, 'store'
    ])->name('karyawan.revisi.store');

    Route::get('/karyawan/revisi/{id}/edit', [
        KaryawanRevisiController::class, 'edit'
    ])->name('karyawan.revisi.edit');

    Route::put('/karyawan/revisi/{id}', [
        KaryawanRevisiController::class, 'update'
    ])->name('karyawan.revisi.update');

    Route::delete('/karyawan/revisi/{id}', [
        KaryawanRevisiController::class, 'destroy'
    ])->name('karyawan.revisi.destroy');


    /*
    |--------------------------------------------------------------------------
    | STATUS PENGERJAAN KARYAWAN
    |--------------------------------------------------------------------------
    */

    Route::get('/karyawan/pengerjaan', [
        KaryawanStatusPengerjaanController::class, 'index'
    ])->name('karyawan.pengerjaan.index');

    Route::put('/karyawan/pengerjaan/{id}', [
        KaryawanStatusPengerjaanController::class, 'update'
    ])->name('karyawan.pengerjaan.update');


    /*
    |--------------------------------------------------------------------------
    | UKURAN ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/ukuran', [
        AdminUkuranController::class, 'index'
    ])->name('admin.ukuran.index');

    Route::get('/admin/ukuran/create', [
        AdminUkuranController::class, 'create'
    ])->name('admin.ukuran.create');

    Route::post('/admin/ukuran', [
        AdminUkuranController::class, 'store'
    ])->name('admin.ukuran.store');

    Route::get('/admin/ukuran/{id}/edit', [
        AdminUkuranController::class, 'edit'
    ])->name('admin.ukuran.edit');

    Route::put('/admin/ukuran/{id}', [
        AdminUkuranController::class, 'update'
    ])->name('admin.ukuran.update');

    Route::delete('/admin/ukuran/{id}', [
        AdminUkuranController::class, 'destroy'
    ])->name('admin.ukuran.destroy');


    /*
    |--------------------------------------------------------------------------
    | REFERENSI MODEL ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/referensi-model', [
        AdminReferensiModelController::class, 'index'
    ])->name('admin.referensi-model.index');

    Route::post('/admin/referensi-model', [
        AdminReferensiModelController::class, 'store'
    ])->name('admin.referensi-model.store');

    Route::get('/admin/referensi-model/{kategori}', [
        AdminReferensiModelController::class, 'kategori'
    ])->whereIn('kategori', [
        'kebaya', 'dress', 'perbaikan'
    ])->name('admin.referensi-model.kategori');

    Route::get('/admin/referensi-model/{kategori}/jenis/{jenis}', [
        AdminReferensiModelController::class, 'jenis'
    ])->whereIn('kategori', [
        'kebaya', 'dress', 'perbaikan'
    ])->name('admin.referensi-model.jenis');

    Route::put('/admin/referensi-model/{referensiModel}', [
        AdminReferensiModelController::class, 'update'
    ])->name('admin.referensi-model.update');

    Route::delete('/admin/referensi-model/{referensiModel}', [
        AdminReferensiModelController::class, 'destroy'
    ])->name('admin.referensi-model.destroy');


    /*
    |--------------------------------------------------------------------------
    | STATUS PENGERJAAN ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/status-pengerjaan', [
        AdminStatusPengerjaanController::class, 'index'
    ])->name('admin.status-pengerjaan.index');

    Route::put('/admin/status-pengerjaan/{id}', [
        AdminStatusPengerjaanController::class, 'update'
    ])->name('admin.status-pengerjaan.update');


    /*
    |--------------------------------------------------------------------------
    | UKURAN SAYA PELANGGAN
    |--------------------------------------------------------------------------
    | Pelanggan dapat melihat, menambah, mengubah, dan menghapus ukuran sendiri.
    |--------------------------------------------------------------------------
    */

    Route::get('/ukuran-saya', [
        UkuranController::class, 'indexPelanggan'
    ])->name('pelanggan.ukuran.index');

    Route::post('/ukuran-saya', [
        UkuranController::class, 'storePelanggan'
    ])->name('pelanggan.ukuran.store');

    Route::put('/ukuran-saya/{id}', [
        UkuranController::class, 'updatePelanggan'
    ])->name('pelanggan.ukuran.update');

    Route::delete('/ukuran-saya/{id}', [
        UkuranController::class, 'destroyPelanggan'
    ])->name('pelanggan.ukuran.destroy');

});
