<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Pelamar\DashboardController as PelamarDashboardController;
use App\Http\Controllers\Perusahaan\DashboardController as PerusahaanDashboardController;
use App\Http\Controllers\Admin\PelamarController as AdminPelamarController;
use App\Http\Controllers\Perusahaan\PelamarController as PerusahaanPelamarController; 
use App\Http\Controllers\Auth\RegisteredUserController;// Mengganti nama alias agar tidak konflik
use App\Http\Controllers\Perusahaan\KandidatPelamarController;
use App\Http\Controllers\Perusahaan\LowonganSayaController;
use App\Http\Controllers\Perusahaan\JadwalController;
use App\Http\Controllers\Perusahaan\NotifikasiController;
use App\Http\Controllers\Perusahaan\BantuanController;
use App\Http\Controllers\Perusahaan\JumlahPelamarController;
use App\Http\Controllers\Perusahaan\WawancaraController;
use App\Http\Controllers\Perusahaan\LowonganPekerjaanController;
use App\Http\Controllers\Perusahaan\DetailPelamarController;
use App\Http\Controllers\Pelamar\BeritaController;
use App\Http\Controllers\Pelamar\HomepageController;
use App\Http\Controllers\Pelamar\LowonganController;
use App\Http\Controllers\Pelamar\PerusahaanController;
use App\Http\Controllers\Pelamar\AktivitasController;
use App\Http\Controllers\Pelamar\ProfilePelamarController;




/*
|--------------------------------------------------------------------------
| Rute Halaman Publik
|--------------------------------------------------------------------------
|
| Rute-rute ini bisa diakses oleh semua pengunjung tanpa perlu login.
|
*/
Route::get('/cari-lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
Route::get('/jelajahi-perusahaan', [PerusahaanController::class, 'index'])->name('perusahaan.index');

// Rute untuk halaman utama (diarahkan ke halaman pelamar)
Route::get('/', function () {
    return view('pelamar.homepage');
})->name('home');

// Rute untuk halaman utama perusahaan (publik)
Route::get('/perusahaan', function () {
    return view('perusahaan.homepage');
})->name('perusahaan');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');


/*
|--------------------------------------------------------------------------
| Rute yang Membutuhkan Otentikasi (Login)
|--------------------------------------------------------------------------
|
| Semua rute di dalam grup ini dilindungi oleh middleware 'auth'.
|
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware('role:pelamar')->group(function () {
        Route::get('/lowongan/detail/{lowongan}', [LowonganController::class, 'showDetailPartial'])->name('lowongan.showDetail');
        Route::post('/lowongan/{lowongan}/simpan', [LowonganController::class, 'toggleSimpan'])->name('lowongan.toggleSimpan');
        
        // PERUBAHAN: Mengganti route 'lamar' yang lama dengan yang baru
        Route::get('/lowongan/{lowongan}/lamar', [LowonganController::class, 'showLamarForm'])->name('lowongan.lamar.form');
        Route::post('/lowongan/{lowongan}/lamar', [LowonganController::class, 'storeLamar'])->name('lowongan.lamar.store');
    });
    // --- AKHIR RUTE INTERAKSI LOWONGAN ---

    // Rute publik yang butuh login
    Route::get('/lamar/success', [LowonganController::class, 'lamarSuccess'])->name('lowongan.lamar.success')->middleware('role:pelamar');

    // Rute khusus untuk Admin Utama
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/homepage', [AdminDashboardController::class, 'homepage'])->name('homepage');
        Route::get('/ranking', [AdminPelamarController::class, 'showAutoRanking'])->name('pelamar.ranking');
        Route::get('/pelamar', [AdminPelamarController::class, 'index'])->name('pelamar.index');

        // Rute Profil untuk Admin
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Rute khusus Pelamar
    Route::middleware('role:pelamar')->prefix('pelamar')->name('pelamar.')->group(function () {
        Route::get('/dashboard', [PelamarDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/settings', [App\Http\Controllers\Pelamar\SettingsController::class, 'index'])->name('settings.index');
        Route::delete('/settings/delete-account', [App\Http\Controllers\Pelamar\SettingsController::class, 'destroy'])->name('settings.destroy');
        Route::put('/settings/update-email', [App\Http\Controllers\Pelamar\SettingsController::class, 'updateEmail'])->name('settings.updateEmail');
        Route::get('/aktivitas', [AktivitasController::class, 'index'])->name('aktivitas.index');
    });


    // Rute khusus untuk Perusahaan
    Route::middleware('role:perusahaan')->prefix('perusahaan')->name('perusahaan.')->group(function () {
        Route::get('/dashboard', [PerusahaanDashboardController::class, 'index'])->name('dashboard');
        Route::get('/lowongan/{lowongan}/pelamar', [PerusahaanPelamarController::class, 'showRankedPelamar'])->name('lowongan.pelamar.ranked');
        Route::get('/kandidat-pelamar', [KandidatPelamarController::class, 'index'])->name('kandidat-pelamar.index');
        Route::get('/lowongan-saya', [LowonganSayaController::class, 'index'])->name('lowongan-saya.index');
        Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
        Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
        Route::get('/bantuan', [BantuanController::class, 'index'])->name('bantuan.index');

        // Rute untuk melihat daftar pelamar dari lowongan tertentu
        Route::get('/lowongan/{lowongan_id}/pelamar', [JumlahPelamarController::class, 'index'])->name('lowongan.pelamar.index');

        // Rute untuk lowongan
        Route::get('/lowongan/create', [LowonganPekerjaanController::class, 'create'])->name('lowongan.create');
        Route::post('/lowongan', [LowonganPekerjaanController::class, 'store'])->name('lowongan.store');

        // Rute untuk tindakan lowongan
        Route::get('/lowongan/{id}', [LowonganPekerjaanController::class, 'view'])->name('lowongan.view');
        Route::get('/lowongan/{id}/edit', [LowonganPekerjaanController::class, 'edit'])->name('lowongan.edit');
        Route::patch('/lowongan/{id}', [LowonganPekerjaanController::class, 'update'])->name('lowongan.update');
        Route::delete('/lowongan/{id}', [LowonganPekerjaanController::class, 'destroy'])->name('lowongan.destroy');

        // Rute untuk jadwal wawancara
        Route::get('/lowongan/{lowongan_id}/pelamar/{pelamar_id}/wawancara/create', [WawancaraController::class, 'create'])->name('wawancara.create');
        Route::post('/wawancara/store', [WawancaraController::class, 'store'])->name('wawancara.store');
        // Rute tanpa parameter (dari tombol "Buat Jadwal Baru")
        Route::get('/wawancara/create', [WawancaraController::class, 'create'])->name('wawancara.create_tanpa_param');

        // Rute Profil untuk Perusahaan
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/upload-logo', [ProfileController::class, 'uploadLogo'])->name('profile.upload_logo'); // Rute baru untuk upload logo
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Rute untuk melihat detail pelamar
        Route::get('/lowongan/{lowongan_id}/pelamar/{pelamar_id}/detail', [DetailPelamarController::class, 'showDetail'])->name('pelamar.detail');
    });
});
// ==================================================================
// == RUTE BARU UNTUK PROSES PEMILIHAN KEAHLIAN ==
// ==================================================================
// Rute ini ditempatkan di luar grup 'auth' karena diakses
// selama proses registrasi, sebelum user sepenuhnya login.
Route::get('/register/keahlian', [RegisteredUserController::class, 'createKeahlian'])->name('register.keahlian.create');
Route::post('/register/keahlian', [RegisteredUserController::class, 'storeKeahlian'])->name('register.keahlian.store');

// Ini memuat semua rute otentikasi bawaan Laravel (login, register, logout, dll)
require __DIR__.'/auth.php';
