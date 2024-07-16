<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $search = $request->input('search');
        session()->put('search', $search);
    
        $query = Buku::query();
    
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('pengarang', 'like', "%{$search}%")
                  ->orWhere('penerbit', 'like', "%{$search}%")
                  ->orWhere('tahunterbit', 'like', "%{$search}%")
                  ->orWhere('stok', 'like', "%{$search}%");
            });
        }
    
        $buku = $query->get();
    
        return view('Buku.index')->with('buku', $buku)->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if($request->user()->cannot('create', Buku::class)){
            abort (403, 'Anda tidak memiliki akses');
            //return redirect()->route('fakultas.index')->with('error', 'Anda tidak memiliki akses');
        }

        $val = $request->validate([
            'judul' => 'required|unique:buku',
            'sinopsis' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahunterbit' => 'required',
            'kategori' => 'required',
            'stok' => 'required',
        ]);
        Buku::create($val);
        return redirect()->route('buku.index')->with('success', $val['judul'] . ' berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        return view('Buku.show')->with('buku', $buku);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        return view('Buku.edit')->with('buku', $buku);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {

        $val = $request->validate([
            'judul' => 'required',
            'sinopsis' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahunterbit' => 'required',
            'kategori' => 'required',
            'stok' => 'required',
        ]);
        $buku->update($val);
        return redirect()->route('buku.index')->with('success', $val['judul'] . ' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        
        $buku->delete();
        return redirect()->route('buku.index') ->with('success', $buku->nama.' data berhasil dihapus');
    }
}
