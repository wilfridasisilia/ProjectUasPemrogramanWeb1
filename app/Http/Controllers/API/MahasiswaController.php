<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();

        if ($mahasiswa->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada mahasiswa yang ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa ditemukan.',
            'data' => $mahasiswa
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'npm' => 'required|unique:mahasiswas',
            'nama' => 'required',
            'alamat' => 'required',
            'jeniskelamin' => 'required',
            'url_foto' => 'required|file|mimes:jpeg,png,jpg|max:5000'
        ]);

        $file = $request->file('url_foto');
        $filename = $validated['npm'] . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/foto', $filename);
        $validated['url_foto'] = $filename;

        $mahasiswa = Mahasiswa::create($validated);

        if ($mahasiswa) {
            return response()->json([
                'success' => true,
                'message' => 'Mahasiswa berhasil ditambahkan.',
                'data' => $mahasiswa
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Mahasiswa gagal ditambahkan.'
        ], 500);
    }

    public function update(Request $request, $idmahasiswa)
    {
        $validated = $request->validate([
            'npm' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'jeniskelamin' => 'required',
            'url_foto' => 'nullable|file|mimes:jpeg,png,jpg|max:5000'
        ]);

        $mahasiswa = Mahasiswa::find($idmahasiswa);

        if (!$mahasiswa) {
            $response['success'] = false;
            $response['message'] = 'Mahasiswa tidak ditemukan.';
            return response()->json($response, 404);
        }

        if ($request->hasFile('url_foto')) {
            // Hapus foto lama jika ada
            if ($mahasiswa->url_foto) {
                Storage::disk('public')->delete('foto/' . $mahasiswa->url_foto);
            }

            // Upload foto baru
            $file = $request->file('url_foto');
            $filename = $validated['npm'] . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/foto', $filename);
            $validated['url_foto'] = $filename;
        }

        // Update data mahasiswa berdasarkan data yang divalidasi
        $mahasiswa->update($validated);

        $response['success'] = true;
        $response['message'] = 'Mahasiswa berhasil diperbarui.';
        $response['data'] = $mahasiswa; // Mengembalikan data mahasiswa yang telah diperbarui
        return response()->json($response, 200);
    }
    public function destroy($idmahasiswa)
    {
        $mahasiswa = Mahasiswa::find($idmahasiswa);
        
        if ($mahasiswa) {
            if ($mahasiswa->url_foto) {
                Storage::disk('public')->delete('foto/' . $mahasiswa->url_foto);
            }

            $mahasiswa->delete();

            return response()->json([
                'success' => true,
                'message' => 'Mahasiswa berhasil dihapus.'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Mahasiswa tidak ditemukan.'
        ], 404);
    }
}
