<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $petugas = Petugas::query()
            ->when($search, function ($q, $search) {
                return $q->where('namapetugas', 'like', "%{$search}%");
            })
            ->get();

        if ($petugas->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada petugas yang ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Petugas ditemukan.',
            'data' => $petugas
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'namapetugas' => 'required',
            'jeniskelamin' => 'required|max:1',
            'alamat' => 'required',
            'notelp' => 'required',
            'email' => 'required|email',
            'fotopetugas' => 'required|image|mimes:jpeg,png,jpg|max:5000'
        ]);

        $ext = $request->fotopetugas->getClientOriginalExtension();
        $validated['fotopetugas'] = $request->namapetugas . 'petugas' . '.' . $ext;
        $request->fotopetugas->move('foto', $validated['fotopetugas']);

        $petugas = Petugas::create($validated);

        if ($petugas) {
            return response()->json([
                'success' => true,
                'message' => 'Petugas berhasil ditambahkan.',
                'data' => $petugas
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Petugas gagal ditambahkan.'
            ], 500);
        }
    }

    public function update(Request $request, $idpetugas)
    {
        $petugas = Petugas::find($idpetugas);
        if (!$petugas) {
            return response()->json([
                'success' => false,
                'message' => 'Petugas tidak ditemukan.'
            ], 404);
        }

        $validated = $request->validate([
            'namapetugas' => 'required',
            'jeniskelamin' => 'required|max:1',
            'alamat' => 'required',
            'notelp' => 'required',
            'email' => 'required|email',
            'fotopetugas' => 'nullable|image|mimes:jpeg,png,jpg|max:5000'
        ]);

        if ($request->hasFile('fotopetugas')) {
            File::delete('foto/' . $petugas->fotopetugas);
            $ext = $request->fotopetugas->getClientOriginalExtension();
            $validated['fotopetugas'] = $request->namapetugas . 'petugas' . '.' . $ext;
            $request->fotopetugas->move('foto', $validated['fotopetugas']);
        }

        $petugas->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Petugas berhasil diperbarui.',
            'data' => $petugas
        ], 200);
    }

    public function destroy($idpetugas)
    {
        $petugas = Petugas::find($idpetugas);
        if (!$petugas) {
            return response()->json([
                'success' => false,
                'message' => 'Petugas tidak ditemukan.'
            ], 404);
        }

        File::delete('foto/' . $petugas->fotopetugas);
        $petugas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Petugas berhasil dihapus.'
        ], 200);
    }
}
