<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;

Route::get('/', function () {
    return view('welcome');
});

// routes untuk authentication login/register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

//routes untuk role pasien
Route::get('/pasien', [PasienController::class, 'index'])->name('dashboardPasien');
Route::get('/pasien/periksa', [PasienController::class, 'showPeriksa'])->name('periksaPasien');
Route::get('/pasien/riwayat', [PasienController::class, 'showRiwayat'])->name('riwayatPasien');

//routes untuk role dokter
Route::get('/dokter', [DokterController::class, 'index'])->name('dashboardDokter');
Route::get('/dokter/periksa', [DokterController::class, 'showPeriksa'])->name('periksaDokter');
Route::get('/dokter/obat', [DokterController::class, 'showObat'])->name('obatDokter');