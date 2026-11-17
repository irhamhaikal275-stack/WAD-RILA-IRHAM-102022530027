<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PemesananUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ---------- Autentikasi (hanya untuk tamu) ----------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ---------- Modul Pemesanan (wajib login) ----------
// Hak akses tiap fitur dicek di controller lewat PemesananPolicy:
//   lihat & tambah -> admin + user
//   edit & hapus   -> admin saja
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin']);
    Route::get('/pemesanan-user', [PemesananUserController::class, 'index']);
    Route::post('/pemesanan-user', [PemesananUserController::class, 'store']);
    Route::get('/pemesanan-user/data', [PemesananUserController::class, 'data']);
    Route::get('/pemesanan-user/{id}/edit', [PemesananUserController::class, 'edit']);
    Route::put('/pemesanan-user/{id}', [PemesananUserController::class, 'update']);
    Route::delete('/pemesanan-user/{id}', [PemesananUserController::class, 'destroy']);
});
