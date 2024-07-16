<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::all();

        if ($peminjaman->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada peminjaman yang ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman ditemukan.',
            'data' => $peminjaman
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idbuku' => 'required|exists:buku,idbuku',
            'idmahasiswa' => 'required|exists:mahasiswas,idmahasiswa',
            'idpetugas' => 'required|exists:petugas,idpetugas',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after:tgl_pinjam',
            'status' => 'required|in:Dipinjam,Tersedia',
        ]);

        $peminjaman = Peminjaman::create($validated);

        if ($peminjaman) {
            return response()->json([
                'success' => true,
                'message' => 'Peminjaman berhasil ditambahkan.',
                'data' => $peminjaman
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Peminjaman gagal ditambahkan.'
        ], 500);
    }

    public function update(Request $request, $idpeminjaman)
    {
        $validated = $request->validate([
            'idbuku' => 'required|exists:buku,idbuku',
            'idmahasiswa' => 'required|exists:mahasiswas,idmahasiswa',
            'idpetugas' => 'required|exists:petugas,idpetugas',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after:tgl_pinjam',
            'status' => 'required|in:Dipinjam,Tersedia',
        ]);

        $peminjaman = Peminjaman::find($idpeminjaman);

        if ($peminjaman) {
            $peminjaman->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Peminjaman berhasil diupdate.',
                'data' => $peminjaman
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Peminjaman tidak ditemukan.'
        ], 404);
    }

    public function destroy($idpeminjaman)
    {
        $peminjaman = Peminjaman::find($idpeminjaman);

        if ($peminjaman) {
            $peminjaman->delete();

            return response()->json([
                'success' => true,
                'message' => 'Peminjaman berhasil dihapus.'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Peminjaman tidak ditemukan.'
        ], 404);
    }
}
