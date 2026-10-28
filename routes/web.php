<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AuthManualController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Halaman login
Route::get('/login', [AuthManualController::class, 'index'])
    ->name('login');

// Proses login
Route::post('/login', [AuthManualController::class, 'login'])
    ->name('loginProses');

// Halaman registrasi
Route::get('/register', [AuthManualController::class, 'register'])
    ->name('register');

// Proses registrasi
Route::post('/register', [AuthManualController::class, 'registerProses'])
    ->name('registerProses');

// Proses logout
Route::post('/logout', [AuthManualController::class, 'logout'])
    ->name('logout');

// Manajemen data kategori, penerbit, dan buku
Route::resource('kategori', KategoriController::class);
Route::resource('penerbit', PenerbitController::class);
Route::resource('buku', BukuController::class);