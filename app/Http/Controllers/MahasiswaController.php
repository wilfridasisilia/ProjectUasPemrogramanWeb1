<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $search = $request->input('search');
        session()->put('search', $search);
    
        $query = Mahasiswa::query();
    
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('npm', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%")
                  ->orWhere('jeniskelamin', 'like', "%{$search}%");
            });
        }
    
        $mahasiswa = $query->get();
    
        return view('Mahasiswa.index', compact('mahasiswa', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Mahasiswa.create');
        

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if($request->user()->cannot('create', Mahasiswa::class)){
            abort (403, 'Anda tidak memiliki akses');
            //return redirect()->route('fakultas.index')->with('error', 'Anda tidak memiliki akses');
        }

        $val = $request->validate([
            'npm' => 'required|unique:mahasiswas',
            'nama' => 'required',
            'alamat' => 'required',
            'jeniskelamin' => 'required',
            'url_foto' => 'required|file|mimes:jpeg,png,jpg|max:5000'
        ]);
        $ext = $val['url_foto']->getClientOriginalExtension();
        $val['url_foto'] = $request->npm . '.' . $ext;
        $request->url_foto->move('foto', $val['url_foto']);
        
        Mahasiswa::create($val);

        return redirect()->route('mahasiswa.index')->with('success', $val['nama'].' berhasil disimpan');
        

    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return view('Mahasiswa.show')->with('mahasiswa', $mahasiswa);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('Mahasiswa.edit')->with('mahasiswa', $mahasiswa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        if($request->hasFile('url_foto')){
            File::delete('foto/'.$mahasiswa->url_foto);
            $val = $request->validate([
                'npm' => 'required' ,
                'nama' => 'required',
                'alamat' => 'required',
                'jeniskelamin' => 'required',
                'url_foto' => 'required|file|mimes:jpeg,png,jpg|max:5000'
            ]);
            $ext = $val['url_foto']->getClientOriginalExtension();
            $val['url_foto'] = $request->npm . '.' . $ext;
            $request->url_foto->move('foto', $val['url_foto']);
        }
        else{
            $val = $request->validate([
                'npm' => 'required',
                'nama' => 'required',
                'alamat' => 'required',
                'jeniskelamin' => 'required',
            ]);
        }
        $mahasiswa->update($val);
        return redirect()->route('mahasiswa.index')->with('success', $val['nama'].' berhasil diubah');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //dd($mahasiswa); //cek file yang akan dihapus
        File::delete('foto/'.$mahasiswa->url_foto); //file dihapus
        $mahasiswa->delete(); // data dihapus
        return redirect()->route('mahasiswa.index') ->with('success', $mahasiswa->nama.' data berhasil dihapus');
    }
}
