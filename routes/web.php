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
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

//routes untuk role pasien
Route::get('/pasien', [PasienController::class, 'index'])->name('dashboardPasien')->middleware('role:pasien', 'auth');
Route::get('/pasien/periksa', [PasienController::class, 'showPeriksa'])->name('periksaPasien')->middleware('role:pasien', 'auth');
Route::post('/pasien/periksa', [PasienController::class, 'storePeriksa'])->name('storePeriksa')->middleware('role:pasien', 'auth');

//routes untuk role dokter
Route::get('/dokter', [DokterController::class, 'index'])->name('dashboardDokter')->middleware('role:dokter', 'auth');
Route::get('/dokter/periksa', [DokterController::class, 'showPeriksa'])->name('periksaDokter')->middleware('role:dokter', 'auth');
Route::put('/dokter/periksa/{id}', [DokterController::class, 'updatePeriksa'])->name('updatePeriksa')->middleware('role:dokter', 'auth');
Route::get('/dokter/obat', [DokterController::class, 'showObat'])->name('obatDokter')->middleware('role:dokter', 'auth');
Route::post('/dokter/obat', [DokterController::class, 'storeObat'])->name('storeObat')->middleware('role:dokter', 'auth');
Route::put('/dokter/obat/{id}', [DokterController::class, 'updateObat'])->name('updateObat')->middleware('role:dokter', 'auth');
Route::delete('/dokter/obat/{id}', [DokterController::class, 'deleteObat'])->name('deleteObat')->middleware('role:dokter', 'auth');