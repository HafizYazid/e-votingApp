<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OTPController;
use App\Http\Middleware\CheckLogin;

// Otentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/marasa', [DashboardController::class, 'marasa']);


// Voting & OTP (hanya bisa diakses jika sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/voting', [VotingController::class, 'index'])->name('voting');
    Route::post('/send-otp', [OTPController::class, 'requestOtp']);       // kirim OTP
    Route::post('/verify-otp', [OTPController::class, 'verifyOTP']);   // verifikasi & login
    Route::post('/submit-vote', [VotingController::class, 'submitVote']);
});
