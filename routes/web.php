<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemesananUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pemesanan-user', [PemesananUserController::class, 'index']);
Route::post('/pemesanan-user', [PemesananUserController::class, 'store']);
Route::get('/pemesanan-user/data', [PemesananUserController::class, 'data']);
Route::get('/pemesanan-user/{id}/edit', [PemesananUserController::class, 'edit']);
Route::put('/pemesanan-user/{id}', [PemesananUserController::class, 'update']);
Route::delete('/pemesanan-user/{id}', [PemesananUserController::class, 'destroy']);