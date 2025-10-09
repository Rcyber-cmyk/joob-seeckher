<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController; // Diubah dari PasswordResetLinkController
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // --- RUTE UNTUK LUPA PASSWORD (OTP) ---
    // Langkah 1: Form untuk memasukkan email
    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
                ->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetCode'])
                ->name('password.email');

    // Langkah 2: Form untuk memasukkan kode OTP
    Route::get('verify-password-otp', [ForgotPasswordController::class, 'showOtpForm'])
                ->name('password.otp.form');
    Route::post('verify-password-otp', [ForgotPasswordController::class, 'verifyOtp'])
                ->name('password.otp.verify');

    // Langkah 3: Form untuk memasukkan password baru
    Route::get('reset-password-form', [ForgotPasswordController::class, 'showResetForm'])
                ->name('password.reset.form');
    Route::post('reset-password', [ForgotPasswordController::class, 'updatePassword'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Route::put('password', [PasswordController::class, 'update'])->name('password.update'); 
    // ^ Catatan: Route 'password.update' sudah digunakan untuk reset, 
    // jika Anda butuh fitur update password setelah login, beri nama lain, contoh: 'password.change'

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

