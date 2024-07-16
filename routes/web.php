<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('petugas', PetugasController::class);
Route::resource('buku', BukuController::class);
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('peminjaman', PeminjamanController::class);
Route::resource('dashboard', DashboardController::class);

Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('buku', [BukuController::class, 'index'])->name('buku.index')->middleware(['auth', 'verified']);
Route::get('mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index')->middleware(['auth', 'verified']);
Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index')->middleware(['auth', 'verified']);
Route::get('petugas', [PetugasController::class, 'index'])->name('petugas.index')->middleware(['auth', 'verified']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
