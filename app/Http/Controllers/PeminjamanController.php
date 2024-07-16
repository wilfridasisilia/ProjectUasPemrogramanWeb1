<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Mahasiswa;
use App\Models\Peminjaman;
use App\Models\Petugas;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        session()->put('search', $search);
        
        $query = Peminjaman::query();
    
        if ($search) {
            $query->whereHas('buku', function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%");
            })->orWhereHas('mahasiswa', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            })->orWhere('status', 'like', "%{$search}%");
        }
    
        $peminjaman = $query->get();
        
        return view('Peminjaman.index', compact('peminjaman', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buku = Buku::all();
        $petugas = Petugas::all();
        $mahasiswa = Mahasiswa::all();
        return view('Peminjaman.create')
            ->with('buku', $buku)
            ->with('petugas', $petugas)
            ->with('mahasiswa', $mahasiswa);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->user()->cannot('create', Peminjaman::class)){
            abort (403, 'Anda tidak memiliki akses');
            //return redirect()->route('fakultas.index')->with('error', 'Anda tidak memiliki akses');
        }


        $val = $request->validate([
            'idbuku' => 'required|exists:buku,idbuku',
            'idmahasiswa' => 'required|exists:mahasiswas,idmahasiswa',
            'idpetugas' => 'required|exists:petugas,idpetugas',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after:tgl_pinjam',
            'status' => 'required|in:Dipinjam,Tersedia',
        ]);
    
        Peminjaman::create($val);
        return redirect()->route('peminjaman.index')->with('success', ' Peminjaman berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        // dd($peminjaman);
        return view('Peminjaman.show')->with('peminjaman', $peminjaman);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        $buku = Buku::all();
        $petugas = Petugas::all();
        $mahasiswa = Mahasiswa::all();
        return view('Peminjaman.edit')
            ->with('buku', $buku)
            ->with('petugas', $petugas)
            ->with('mahasiswa', $mahasiswa)
            ->with('peminjaman', $peminjaman);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $val = $request->validate([
            'idbuku' => 'required|exists:buku,idbuku',
            'idmahasiswa' => 'required|exists:mahasiswas,idmahasiswa',
            'idpetugas' => 'required|exists:petugas,idpetugas',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after:tgl_pinjam',
            'status' => 'required|in:Dipinjam,Tersedia',
        ]);
    
        $peminjaman->update($val);
        return redirect()->route('peminjaman.index')->with('success', ' Peminjaman berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        // dd($peminjaman);
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', ' Peminjaman berhasil dihapus');
    }
}