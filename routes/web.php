<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AuthManualController;
Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth'])->group(function(){
    Route::resource('kategori', KategoriController::class);
    Route::resource('penerbit', PenerbitController::class);
    Route::resource('buku', BukuController::class);
});


// Route untuk login
Route::get('/login', [AuthManualController::class, 'index'])
    ->name('login');

Route::post('/login', [AuthManualController::class, 'login'])
    ->name('loginProses');

// Route untuk logout
Route::post('/logout', [AuthManualController::class, 'logout'])
    ->name('logout');