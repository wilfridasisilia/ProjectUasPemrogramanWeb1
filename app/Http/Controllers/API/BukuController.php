<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        if ($buku->isEmpty()) {
            return response()->json(['message' => 'Tidak ada buku yang ditemukan.', 'success' => false], 404);
        }

        return response()->json(['message' => 'Buku ditemukan.', 'success' => true, 'data' => $buku], 200);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'judul' => 'required',
            'sinopsis' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahunterbit' => 'required',
            'kategori' => 'required',
            'stok' => 'required|integer|min:0', 
        ]);

        $buku = Buku::create($validate);

        if ($buku) {
            return response()->json(['message' => 'Buku berhasil ditambahkan.', 'success' => true], 201);
        } else {
            return response()->json(['message' => 'Buku gagal ditambahkan.', 'success' => false], 500);
        }
    }

    public function update(Request $request, $idbuku)
    {
        $validate = $request->validate([
            'judul' => 'required',
            'sinopsis' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahunterbit' => 'required',
            'kategori' => 'required',
            'stok' => 'required|integer|min:0',
        ]);

        $updated = Buku::where('idbuku', $idbuku)->update($validate);

        if ($updated) {
            return response()->json(['message' => 'Buku berhasil diperbarui.', 'success' => true], 200);
        } else {
            return response()->json(['message' => 'Buku tidak ditemukan atau tidak ada perubahan yang dilakukan.', 'success' => false], 404);
        }
    }

    public function destroy($idbuku)
    {
        $buku = Buku::find($idbuku);

        if (!$buku) {
            return response()->json(['message' => 'Buku tidak ditemukan.', 'success' => false], 404);
        }

        $buku->delete();

        return response()->json(['message' => 'Buku berhasil dihapus.', 'success' => true], 200);
    }
}
