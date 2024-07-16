@extends('Layout.main')

@section('title', 'Edit Petugas')

@section('content')
<div class="container-fluid px-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card rounded-3">
                <div class="card-body">
                    <h4 class="card-title fw-bold text-primary">Edit Petugas</h4>
                    <p class="card-description">
                        Formulir Ubah Petugas Perpustakaan
                    </p>
                    <form class="forms-sample" action="{{ route('petugas.update', $petugas['idpetugas']) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="fotopetugas" class="fw-bold text-primary">Foto Petugas</label>
                            <input type="file" name="fotopetugas" id="fotopetugas" class="form-control">
                            @error('fotopetugas')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="namapetugas" class="text-primary fw-bold">Nama Petugas</label>
                            <input type="text" name="namapetugas" id="namapetugas" value="{{ old('namapetugas', $petugas->namapetugas) }}" class="form-control">
                            @error('namapetugas')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jeniskelamin" class="text-primary fw-bold">Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jeniskelamin" id="jeniskelaminP" value="P" {{ (old('jeniskelamin', $petugas->jeniskelamin) == 'P') ? 'checked' : '' }}>
                                <label class="form-check-label" for="jeniskelaminP">Perempuan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jeniskelamin" id="jeniskelaminL" value="L" {{ (old('jeniskelamin', $petugas->jeniskelamin) == 'L') ? 'checked' : '' }}>
                                <label class="form-check-label" for="jeniskelaminL">Laki-Laki</label>
                            </div>
                            @error('jeniskelamin')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="text-primary fw-bold">Alamat</label>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $petugas->alamat) }}" class="form-control">
                            @error('alamat')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="notelp" class="text-primary fw-bold">No Telephone</label>
                            <input type="text" name="notelp" id="notelp" value="{{ old('notelp', $petugas->notelp) }}" class="form-control">
                            @error('notelp')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-primary fw-bold">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $petugas->email) }}" class="form-control">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ url('petugas') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection