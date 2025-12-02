<?php

use App\Http\Controllers\Admin\CetakInvoice as AdminCetakInvoice;
use App\Http\Controllers\Admin\CetakPendaftaran as AdminCetakPendaftaran;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\HapusTransaksiController;
use App\Http\Controllers\Admin\LaporanBulananController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\RiwayatPendaftaranController;
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CetakInvoice;
use App\Http\Controllers\CetakPendaftaran;
use App\Http\Controllers\Mahasiswa\PendaftaranController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransWebhookController;
use App\Http\Controllers\DashboardMahasiswaController;
use App\Http\Controllers\Mahasiswa\BiodataController;

// login mahasiswa
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/auth/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// login admin
Route::get('/login-admin', [LoginAdminController::class, 'index'])->name('login.admin');
Route::post('/auth/login/admin', [LoginAdminController::class, 'login'])->name('login.admin.post');
Route::get('/logout/admin', [LoginAdminController::class, 'logout'])->name('logout.admin');

// Notif Handler MIDTRANS
Route::post('/midtrans/notification', [MidtransWebhookController::class, 'handle']);

// Mahasiswa
Route::middleware(['auth.mahasiswa'])->prefix('mahasiswa')->group(function () {

    // Dashboard Mahasiswa
    Route::get('/dashboard', [DashboardMahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    // Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');

    //Halaman Pendaftaran
    Route::get('kkn/pendaftaran', [BiodataController::class, 'index'])->name('mahasiswa.biodata.index');
    Route::post('kkn/pendaftaran', [BiodataController::class, 'biodata'])->name('mahasiswa.biodata.update');

    // Halaman, Pembayaran dan Transaksi
    Route::get('/kkn', [PendaftaranController::class, 'index'])->name('mahasiswa.pembayaran');
    Route::post('/kkn/pembayaran', [PendaftaranController::class, 'createTransaction'])->name('mahasiswa.pembayaran.daftar');

    // Cancel Transaksi
    Route::post('/kkn/cancel/{id}', [PendaftaranController::class, 'cancelTransaction'])->name('mahasiswa.pembayaran.cancel');

    // Riwayat Transaksi
    Route::get('/riwayat-transaksi', [PendaftaranController::class, 'riwayatTransaksi'])->name('mahasiswa.riwayat');
    // Cetak Invoice
    Route::get('/riwayat/cetak/{id}', [CetakInvoice::class, 'cetakTransaksi']) // Sesuaikan Controller
        ->name('mahasiswa.cetak');
    // Cetak Form Pendaftaran
    Route::get('/riwayat/cetak/pendaftaran/{id}', [CetakPendaftaran::class, 'cetakPendaftaran']) // Sesuaikan Controller
        ->name('mahasiswa.cetak.pendaftaran');
});

// Admin
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    // Route mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.admin');

    // Riwayat Transaksi
    Route::get('/riwayat-transaksi', [RiwayatPendaftaranController::class, 'riwayatTransaksi'])->name('admin.riwayat');

    // Cetak Invoice
    Route::get('/riwayat/cetak/{id}', [AdminCetakInvoice::class, 'cetakTransaksi']) // Sesuaikan Controller
        ->name('admin.cetak');

    // Cetak Form Pendaftaran
    Route::get('/riwayat/cetak/pendaftaran/{id}', [AdminCetakPendaftaran::class, 'cetakPendaftaran']) // Sesuaikan Controller
        ->name('admin.cetak.pendaftaran');

    // Hapus Transaksi
    Route::delete('/riwayat/hapus/{id}', [HapusTransaksiController::class, 'hapusTransaksi'])
        ->name('admin.hapus.transaksi');

    Route::get('/laporan-bulanan', [LaporanBulananController::class, 'index'])->name('admin.laporan.bulanan');
});

Route::get('/profile', function () {
    return view('profile');
})->name('profile');


Route::get('/cek', function () {
    return view('cek');
})->name('cek');
