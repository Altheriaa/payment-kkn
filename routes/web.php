<?php

use App\Http\Controllers\Admin\CetakInvoice as AdminCetakInvoice;
use App\Http\Controllers\Admin\CetakPendaftaran as AdminCetakPendaftaran;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\HapusTransaksiController;
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
use App\Http\Controllers\Mahasiswa\ProfileController;
use App\Http\Controllers\Admin\JadwalKknController;
use App\Http\Controllers\Admin\LokasiKknController;
use App\Http\Controllers\Admin\DosenDplController;
use App\Http\Controllers\Admin\PlottingController;
use App\Http\Controllers\Admin\KelolaAnggotaController;
use App\Http\Controllers\LandingPageController;

// Landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');

// login mahasiswa
Route::get('/login', [LoginController::class, 'index'])->name('login');
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

    //Profil Mahasiswa
    Route::get('/profile', [ProfileController::class, 'index'])->name('mahasiswa.profile');
});

// Admin
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    // Route mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.admin');

    // Lihat Detail Mahasiswa 
    Route::get('mahasiswa/detail/{id}', [MahasiswaController::class, 'detail'])->name('mahasiswa.detail');

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

    // sinkron jadwal
    Route::get('/jadwal-kkn', [JadwalKknController::class, 'index'])->name('admin.jadwal-kkn');
    Route::post('/sinkron-jadwal', [JadwalKknController::class, 'sync'])->name('admin.sinkron.jadwal');

    // Lokasi KKN
    Route::get('/lokasi-kkn', [LokasiKknController::class, 'index'])->name('admin.lokasi-kkn');
    Route::post('/lokasi-kkn', [LokasiKknController::class, 'store'])->name('tambahLokasiKkn');
    Route::delete('/lokasi-kkn/hapus/{id}', [LokasiKknController::class, 'delete'])->name('hapusLokasiKkn');
    Route::put('/lokasi-kkn/update/{id}', [LokasiKknController::class, 'update'])->name('updateLokasiKkn');

    // Dosen DPL
    Route::get('/dosen-dpl', [DosenDplController::class, 'index'])->name('admin.dosen-dpl');
    Route::post('/dosen-dpl', [DosenDplController::class, 'store'])->name('tambahDosen');
    Route::delete('/dosen-dpl/hapus/{id}', [DosenDplController::class, 'delete'])->name('hapusDosen');
    Route::put('/dosen-dpl/update/{id}', [DosenDplController::class, 'update'])->name('updateDosen');

    // Plotting Admin
    Route::get('/plotting', [PlottingController::class, 'index'])->name('admin.plotting');
    Route::post('/plotting-kelompok/tambah', [PlottingController::class, 'storeKelompok'])->name('tambahKelompok');
    Route::delete('/plotting-kelompok/hapus/{id}', [PlottingController::class, 'deleteKelompok'])->name('hapusKelompok');
    Route::put('/plotting-kelompok/update/{id}', [PlottingController::class, 'updateKelompok'])->name('updateKelompok');
    // Kelola Anggota
    Route::get('/plotting/kelola-anggota', [KelolaAnggotaController::class, 'index'])->name('admin.plotting.kelola-anggota');

    // Laporan Bulanan

    // Route::get('/laporan-bulanan', [LaporanBulananController::class, 'laporanBulanan'])->name('admin.laporan.bulanan');

    // Cetak Laporan Bulanan
    // Route::get('/laporan-bulanan/cetak/{bulan}/{tahun}', [LaporanBulananController::class, 'cetakLaporanBulanan'])
    //     ->name('admin.cetak.laporan');
});
