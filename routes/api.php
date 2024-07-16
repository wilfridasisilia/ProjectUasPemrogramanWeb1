<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BukuController;
use App\Http\Controllers\API\MahasiswaController;
use App\Http\Controllers\API\PeminjamanController;
use App\Http\Controllers\API\PetugasController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Buku
Route::middleware(['auth:sanctum', 'ability:read-buku'])->get('buku', [BukuController::class, 'index']);
Route::middleware(['auth:sanctum', 'ability:create-buku'])->post('buku', [BukuController::class, 'store']);
Route::middleware(['auth:sanctum', 'ability:update-buku'])->put('buku/{idbuku}', [BukuController::class, 'update']);
Route::middleware(['auth:sanctum', 'ability:delete-buku'])->delete('buku/{idbuku}', [BukuController::class, 'destroy']);

// mahasiswa
Route::middleware(['auth:sanctum', 'ability:read-mahasiswa'])->get('mahasiswa', [MahasiswaController::class, 'index']);
Route::middleware(['auth:sanctum', 'ability:create-mahasiswa'])->post('mahasiswa', [MahasiswaController::class, 'store']);
Route::middleware(['auth:sanctum', 'ability:update-mahasiswa'])->put('mahasiswa/{idmahasiswa}', [MahasiswaController::class, 'update']);
Route::middleware(['auth:sanctum', 'ability:delete-mahasiswa'])->delete('mahasiswa/{idmahasiswa}', [MahasiswaController::class, 'destroy']);


// petugas
Route::middleware(['auth:sanctum', 'ability:read-petugas'])->get('petugas', [PetugasController::class, 'index']);
Route::middleware(['auth:sanctum', 'ability:create-petugas'])->post('petugas', [PetugasController::class, 'store']);
Route::middleware(['auth:sanctum', 'ability:update-petugas'])->put('petugas/{idpetugas}', [PetugasController::class, 'update']);
Route::middleware(['auth:sanctum', 'ability:delete-petugas'])->delete('petugas/{idpetugas}', [PetugasController::class, 'destroy']);

// peminjaman
Route::middleware(['auth:sanctum', 'ability:read-peminjaman'])->get('peminjaman', [PeminjamanController::class, 'index']);
Route::middleware(['auth:sanctum', 'ability:create-peminjaman'])->post('peminjaman', [PeminjamanController::class, 'store']);
Route::middleware(['auth:sanctum', 'ability:update-peminjaman'])->put('peminjaman/{idpeminjaman}', [PeminjamanController::class, 'update']);
Route::middleware(['auth:sanctum', 'ability:delete-peminjaman'])->delete('peminjaman/{idpeminjaman}', [PeminjamanController::class, 'destroy']);

// Auth
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);




