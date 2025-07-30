<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Pelamar\DashboardController as PelamarDashboardController;
use App\Http\Controllers\Perusahaan\DashboardController as PerusahaanDashboardController;
use App\Http\Controllers\Admin\PelamarController as AdminPelamarController;
use App\Http\Controllers\Perusahaan\PelamarController as PerusahaanPelamarController; 
use App\Http\Controllers\Auth\RegisteredUserController;// Mengganti nama alias agar tidak konflik

/*
|--------------------------------------------------------------------------
| Rute Halaman Publik
|--------------------------------------------------------------------------
|
| Rute-rute ini bisa diakses oleh semua pengunjung tanpa perlu login.
|
*/

// Rute untuk halaman utama (diarahkan ke halaman pelamar)
Route::get('/', function () {
    return view('pelamar.homepage');
})->name('home');

// Rute untuk halaman utama perusahaan (publik)
Route::get('/perusahaan', function () {
    return view('perusahaan.homepage');
})->name('perusahaan');


/*
|--------------------------------------------------------------------------
| Rute yang Membutuhkan Otentikasi (Login)
|--------------------------------------------------------------------------
|
| Semua rute di dalam grup ini dilindungi oleh middleware 'auth'.
|
*/
Route::middleware('auth')->group(function () {

    // --- GRUP BERDASARKAN ROLE ---

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

    // Rute khusus untuk Pelamar
    Route::middleware('role:pelamar')->prefix('pelamar')->name('pelamar.')->group(function () {
        Route::get('/dashboard', [PelamarDashboardController::class, 'index'])->name('dashboard');

        // Rute Profil untuk Pelamar
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        

        // Rute untuk menangani pembaruan keahlian via AJAX
    Route::patch('/profile/update-keahlian', [App\Http\Controllers\ProfileController::class, 'updateKeahlian'])->name('profile.updateKeahlian');
    Route::delete('/profile/delete-cv', [App\Http\Controllers\ProfileController::class, 'deleteCv'])->name('profile.deleteCv');
        
        // Tambahkan rute lain khusus pelamar di sini
        // Contoh: Route::get('/aktivitas', ...)->name('aktivitas.index');
    });

    // Rute khusus untuk Perusahaan
    Route::middleware('role:perusahaan')->prefix('perusahaan')->name('perusahaan.')->group(function () {
        Route::get('/dashboard', [PerusahaanDashboardController::class, 'index'])->name('dashboard');
        Route::get('/lowongan/{lowongan}/pelamar', [PerusahaanPelamarController::class, 'showRankedPelamar'])->name('lowongan.pelamar.ranked');

        // Rute Profil untuk Perusahaan
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
