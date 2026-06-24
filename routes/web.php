<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PoliController as AdminPoliController;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\RiwayatPasienController as AdminRiwayatController;
use App\Http\Controllers\Dokter\JadwalDokterController;
use App\Http\Controllers\Dokter\PeriksaPasienController;
use App\Http\Controllers\Dokter\RiwayatPasienController;
use App\Http\Controllers\Pasien\PasienDashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 📄 Dokumen Presentasi UAS (Downloadable)
Route::get('/dokumen-uas', function () {
    return view('dokumen.uas');
})->name('dokumen.uas');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::resource('polis', AdminPoliController::class);
    Route::resource('dokter', DokterController::class);
    Route::resource('pasien', PasienController::class);
    Route::resource('obat', ObatController::class);

    // ✅ Riwayat Pasien (Admin)
    Route::get('/riwayat', [AdminRiwayatController::class, 'index'])->name('admin.riwayat.index');
    Route::get('/riwayat/{id}', [AdminRiwayatController::class, 'show'])->name('admin.riwayat.show');
    Route::delete('/riwayat/{id}/hapus', [AdminRiwayatController::class, 'destroy'])->name('admin.riwayat.destroy');
});

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dashboard');

    // ✅ CRUD Jadwal Periksa
    Route::resource('jadwal', JadwalDokterController::class)->except(['show']);

    // ✅ Periksa Pasien
    Route::get('/periksa', [PeriksaPasienController::class, 'index'])->name('periksa.index');
    Route::get('/periksa/{id}/edit', [PeriksaPasienController::class, 'edit'])->name('periksa.edit');
    Route::patch('/periksa/{id}', [PeriksaPasienController::class, 'update'])->name('periksa.update');

    // ✅ Riwayat Pasien
    Route::get('/riwayat', [RiwayatPasienController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat/{id}', [RiwayatPasienController::class, 'show'])->name('riwayat.show');
    Route::post('/riwayat/{id}/tambah', [RiwayatPasienController::class, 'tambahRiwayat'])->name('riwayat.tambah');
});

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', [PasienDashboardController::class, 'index'])->name('pasien.dashboard');
    Route::post('/daftar-poli', [PasienDashboardController::class, 'store'])->name('pasien.daftar');
    Route::get('/get-dokter/{id_poli}', [PasienDashboardController::class, 'getDokter'])->name('pasien.get-dokter');
    Route::get('/get-jadwal/{id_dokter}', [PasienDashboardController::class, 'getJadwal'])->name('pasien.get-jadwal');
});
