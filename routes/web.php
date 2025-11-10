<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pelamar\AktivitasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Pelamar\DashboardController as PelamarDashboardController;
use App\Http\Controllers\Perusahaan\DashboardController as PerusahaanDashboardController;
use App\Http\Controllers\Admin\PelamarController as AdminPelamarController;
use App\Http\Controllers\Perusahaan\PelamarController as PerusahaanPelamarController; 
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Perusahaan\KandidatPelamarController;
use App\Http\Controllers\Perusahaan\LowonganSayaController;
use App\Http\Controllers\Perusahaan\JadwalController;
use App\Http\Controllers\Perusahaan\NotifikasiController;
use App\Http\Controllers\Perusahaan\BantuanController;
use App\Http\Controllers\Perusahaan\JumlahPelamarController;
use App\Http\Controllers\Perusahaan\WawancaraController;
use App\Http\Controllers\Perusahaan\LowonganPekerjaanController;
use App\Http\Controllers\Perusahaan\DetailPelamarController;
use App\Http\Controllers\Perusahaan\IklanController;
use App\Http\Controllers\Perusahaan\PengaturanController;
use App\Http\Controllers\Perusahaan\CariKandidatController;
use App\Http\Controllers\Perusahaan\LanggananController;
use App\Http\Controllers\Perusahaan\UndanganController;
use App\Http\Controllers\Pelamar\BeritaController;
use App\Http\Controllers\Pelamar\HomepageController;
use App\Http\Controllers\Pelamar\LowonganController;
use App\Http\Controllers\Pelamar\PerusahaanController;
use App\Http\Controllers\Pelamar\ProfilePelamarController;
// Ganti nama alias controller UMKM agar lebih jelas
use App\Http\Controllers\umkm\UmkmController; 
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\Admin\PerusahaanController as AdminPerusahaanController;
use App\Http\Controllers\Auth\SocialLoginController; 
use App\Http\Controllers\Admin\NotifikasiAdminController;
use App\Http\Controllers\Admin\LowonganAdminController;
use App\Http\Controllers\Admin\PengaturanAdminController;
use App\Http\Controllers\Admin\KandidatAdminController;

/*
|--------------------------------------------------------------------------
| Rute Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/cari-lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
Route::get('/jelajahi-perusahaan', [PerusahaanController::class, 'index'])->name('perusahaan.index');

// [DIUBAH] Arahkan rute utama ke PelamarDashboardController
Route::get('/', [PelamarDashboardController::class, 'index'])->name('home');

Route::get('/perusahaan', function () {
    return view('perusahaan.homepage');
})->name('perusahaan');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('/toko-umkm', [UmkmController::class, 'indexToko'])->name('toko-umkm.index');

/*
|--------------------------------------------------------------------------
| Rute yang Membutuhkan Otentikasi (Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('marketplace.index');
    Route::get('/marketplace/{product}', [MarketplaceController::class, 'show'])->name('marketplace.show');
    Route::middleware('role:pelamar')->group(function () {
         Route::get('/lowongan/detail/{lowongan}', [LowonganController::class, 'showDetailPartial'])->name('lowongan.showDetail');
        Route::post('/lowongan/{lowongan}/simpan', [LowonganController::class, 'toggleSimpan'])->name('lowongan.toggleSimpan');
        
        // PERUBAHAN: Mengganti route 'lamar' yang lama dengan yang baru
        Route::get('/lowongan/{lowongan}/lamar', [LowonganController::class, 'showLamarForm'])->name('lowongan.lamar.form');
        Route::post('/lowongan/{lowongan}/lamar', [LowonganController::class, 'storeLamar'])->name('lowongan.lamar.store');

    });

     Route::get('/lamar/success', [LowonganController::class, 'lamarSuccess'])->name('lowongan.lamar.success')->middleware('role:pelamar');

    // Rute khusus untuk Admin Utama
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/homepage', [AdminDashboardController::class, 'homepage'])->name('homepage');
        Route::get('/ranking', [AdminPelamarController::class, 'showAutoRanking'])->name('pelamar.ranking');
        Route::get('/pelamar', [AdminPelamarController::class, 'index'])->name('pelamar.index');
        Route::get('/perusahaan', [AdminPerusahaanController::class, 'index'])->name('perusahaan.index');
        Route::get('/perusahaan/{perusahaan}', [AdminPerusahaanController::class, 'show'])->name('perusahaan.show');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/notifikasi', [NotifikasiAdminController::class, 'index'])
        ->name('notifikasi.index');
        Route::get('/lowongan/{lowongan}', [LowonganAdminController::class, 'show'])->name('lowongan.show');
        // INI ROUTE BARUNYA:
        Route::get('/pengaturan', [PengaturanAdminController::class, 'index'])->name('pengaturan.index');
        Route::get('kandidat', [KandidatAdminController::class, 'index'])->name('kandidat.index');

        Route::post('kandidat/{id}/setujui', [KandidatAdminController::class, 'approve'])->name('kandidat.approve');
        Route::post('kandidat/{id}/tolak', [KandidatAdminController::class, 'reject'])->name('kandidat.reject');
        
        
        // ================= KODE DIPERBAIKI =================
        // Menggunakan alias AdminPelamarController yang sudah di-import
        Route::get('/pelamar/{id}/detail', [AdminPelamarController::class, 'show'])->name('pelamar.show');
        // ===================================================
    });

    // Rute khusus Pelamar
    Route::middleware('role:pelamar')->prefix('pelamar')->name('pelamar.')->group(function () {
        Route::get('/dashboard', [PelamarDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        // INI SOLUSINYA
        Route::post('/pelamar/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/settings', [App\Http\Controllers\Pelamar\SettingsController::class, 'index'])->name('settings.index');
        Route::delete('/settings/delete-account', [App\Http\Controllers\Pelamar\SettingsController::class, 'destroy'])->name('settings.destroy');
        Route::put('/settings/update-email', [App\Http\Controllers\Pelamar\SettingsController::class, 'updateEmail'])->name('settings.updateEmail');
        Route::get('/aktivitas', [AktivitasController::class, 'index'])->name('aktivitas.index');
        Route::get('/lowongan/{id}', [LowonganController::class, 'show'])->name('lowongan.show');
    });
    Route::delete('/lamaran/{lamaran}', [AktivitasController::class, 'destroyLamaran'])
         // Middleware 'auth' sudah otomatis dari grup luar
         ->middleware('role:pelamar') // Pastikan hanya pelamar yang bisa
         ->name('pelamar.lamaran.destroy');

    // Rute khusus untuk UMKM
    Route::middleware('role:umkm')->prefix('umkm')->name('umkm.')->group(function () {
        Route::get('/dashboard', [UmkmController::class, 'dashboard'])->name('dashboard');
        // Anda bisa menambahkan rute lain khusus UMKM di sini, contoh:
        // Route::get('/profile', [UmkmController::class, 'profile'])->name('profile');
        // Route::get('/lowongan', [UmkmController::class, 'lowongan'])->name('lowongan');
    });

    // Rute khusus untuk Perusahaan
    Route::middleware('role:perusahaan')->prefix('perusahaan')->name('perusahaan.')->group(function () {
        Route::get('/dashboard', [PerusahaanDashboardController::class, 'index'])->name('dashboard');
        Route::get('/lowongan/{lowongan}/pelamar', [PerusahaanPelamarController::class, 'showRankedPelamar'])->name('lowongan.pelamar.ranked');
        Route::get('/kandidat-pelamar', [KandidatPelamarController::class, 'index'])->name('kandidat-pelamar.index');
        Route::get('/lowongan-saya', [LowonganSayaController::class, 'index'])->name('lowongan-saya.index');
        Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
        Route::get('/bantuan', [BantuanController::class, 'index'])->name('bantuan.index');
        
        Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');

        Route::get('/perusahaan/notifikasi/{notificationId}/baca', [NotifikasiController::class, 'readAndRedirect'])->name('perusahaan.notifikasi.readAndRedirect');
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
        Route::get('/jadwal/{id}/view', [JadwalController::class, 'view'])->name('jadwal.view');
        Route::get('/jadwal/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
        Route::patch('/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');

        // Rute untuk menampilkan form pasang iklan
        Route::get('/iklan/pasang-baru', [IklanController::class, 'create'])
             ->name('iklan.create');

        Route::get('/pengaturan', [PengaturanController::class, 'edit'])->name('settings.edit');
    
    // Route untuk memproses update pengaturan
        Route::patch('/pengaturan', [PengaturanController::class, 'update'])->name('settings.update');

        // Rute Profil untuk Perusahaan
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/upload-logo', [ProfileController::class, 'uploadLogo'])->name('profile.upload_logo'); // Rute baru untuk upload logo
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/cari-kandidat', [CariKandidatController::class, 'index'])->name('cari-kandidat.index');
        Route::get('/kandidat/cari', [CariKandidatController::class, 'search'])->name('kandidat.search');
        Route::get('/kandidat/premium', [CariKandidatController::class, 'searchPremium'])->name('kandidat.search.premium');
        Route::get('langganan', [LanggananController::class, 'index'])->name('langganan.index');
        Route::post('langganan/process', [LanggananController::class, 'processPayment'])->name('langganan.process');

        // --- RUTE UNTUK FITUR UNDANG MELAMAR (BARU) ---
        Route::post('/kandidat/{pelamar}/undang', [UndanganController::class, 'store'])->name('kandidat.undang');

        // Rute untuk melihat detail pelamar
        Route::get('/lowongan/{lowongan_id}/pelamar/{pelamar_id}/detail', [DetailPelamarController::class, 'showDetail'])->name('pelamar.detail');
    });
});

// Rute untuk proses pemilihan keahlian setelah registrasi
Route::get('/register/keahlian', [RegisteredUserController::class, 'createKeahlian'])->name('register.keahlian.create');
Route::post('/register/keahlian', [RegisteredUserController::class, 'storeKeahlian'])->name('register.keahlian.store');

Route::middleware('auth')->group(function () {
    Route::get('/verify-otp', [OtpVerificationController::class, 'show'])->name('otp.verification.notice');
    Route::post('/verify-otp', [OtpVerificationController::class, 'verify'])->name('otp.verification.verify');
});

Route::get('/login/google', [SocialLoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [SocialLoginController::class, 'handleGoogleCallback']);

// Memuat semua rute otentikasi bawaan Laravel
require __DIR__.'/auth.php';

