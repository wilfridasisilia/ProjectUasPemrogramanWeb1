<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PeminjamanController;
use App\Models\Buku;
use App\Http\Controllers\PetugasController;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('petugas', PetugasController::class);
Route::resource('buku', BukuController::class);
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('peminjaman', PeminjamanController::class);

