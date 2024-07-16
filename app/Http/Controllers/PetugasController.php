<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\File;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        session()->put('search', $search);
        $petugas = Petugas::query()
            ->when($search, function ($q, $search) {
                return $q->Where('namapetugas', 'like', "%{$search}%");
            })
            ->get();
            
        return view('Petugas.index', compact('petugas', 'search'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if($request->user()->cannot('create', Petugas::class)){
            abort (403, 'Anda tidak memiliki akses');
            //return redirect()->route('fakultas.index')->with('error', 'Anda tidak memiliki akses');
        }

        $val = $request->validate([
            'namapetugas' => 'required',
            'jeniskelamin' => 'required|max:1',
            'alamat' => 'required',
            'notelp' => 'required',
            'email' => 'required',
            'fotopetugas' => 'required|image|mimes:jpeg,png,jpg|max:5000'
        ]);
        $ext = $request->fotopetugas->getClientOriginalExtension();
        $val['fotopetugas'] = $request->namapetugas . 'petugas' . '.' . $ext;
        $request->fotopetugas->move('foto', $val['fotopetugas']);
        Petugas::create($val);
    
        return redirect()->route('petugas.index')->with('success', $val['namapetugas'] . ' berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show($petugas)
    {
        $petugas = Petugas::find($petugas);
        return view('Petugas.show')->with('petugas', $petugas);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($petugas)
    {
       $petugas = Petugas::find($petugas);
         return view('Petugas.edit')->with('petugas', $petugas); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $petugas)
    {
        $petugas = Petugas::find($petugas);
        
        if($request->hasFile('fotopetugas')){
            File::delete('foto/'.$petugas->fotopetugas);
            $val = $request->validate([
                'namapetugas' => 'required',
                'jeniskelamin' => 'required|max:1',
                'alamat' => 'required',
                'notelp' => 'required',
                'email' => 'required',
                'fotopetugas' => 'required|image|mimes:jpeg,png,jpg|max:5000'
            ]);
            $ext = $val['fotopetugas']->getClientOriginalExtension();
            $val['fotopetugas'] = $request->namapetugas . 'petugas' .  '.' . $ext;
            $request->fotopetugas->move('foto', $val['fotopetugas']);
        }
        else{
            $val = $request->validate([
                'namapetugas' => 'required',
                'jeniskelamin' => 'required|max:1',
                'alamat' => 'required',
                'notelp' => 'required',
                'email' => 'required'
            ]);
        }
        $petugas->update($val);
        return redirect()->route('petugas.index')->with('success', $val['namapetugas'] . ' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($petugas)
    {
        $petugas = Petugas::find($petugas);
        // dd($petugas);
        File::delete('foto/'.$petugas->fotopetugas);
        $petugas->delete();
        return redirect()->route('petugas.index')->with('success', ' data berhasil dihapus');
    }
}
