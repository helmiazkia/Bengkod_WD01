<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Routes untuk Authentication: Login, Register, Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Routes untuk Role: Pasien
Route::middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/pasien', [PasienController::class, 'index'])->name('dashboardPasien');
    Route::get('/pasien/periksa', [PasienController::class, 'showPeriksa'])->name('periksaPasien');
    Route::post('/pasien/periksa', [PasienController::class, 'storePeriksa'])->name('storePeriksa');
});

// Routes untuk Role: Dokter
Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/dokter', [DokterController::class, 'index'])->name('dashboardDokter');
    Route::get('/dokter/periksa', [DokterController::class, 'showPeriksa'])->name('periksaDokter');
    Route::put('/dokter/periksa/{id}', [DokterController::class, 'updatePeriksa'])->name('updatePeriksa');

    Route::get('/dokter/obat', [DokterController::class, 'showObat'])->name('obatDokter');
    Route::post('/dokter/obat', [DokterController::class, 'storeObat'])->name('storeObat');
    Route::put('/dokter/obat/{id}', [DokterController::class, 'updateObat'])->name('updateObat');
    Route::delete('/dokter/obat/{id}', [DokterController::class, 'deleteObat'])->name('deleteObat');
});
