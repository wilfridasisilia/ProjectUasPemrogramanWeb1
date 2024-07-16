@extends('Layout.main')

@section('title', 'Tambah Petugas')

@section('content')
<div class="container-fluid px-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card rounded-3">
                <div class="card-body">
                    <h4 class="card-title fw-bold text-primary">Tambah Petugas</h4>
                    <p class="card-description">
                        Formulir Tambah Petugas Perpustakaan
                    </p>
                    <form class="forms-sample" action="{{ route('petugas.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="fotopetugas" class="text-primary">Foto Petugas</label>
                            <input type="file" name="fotopetugas" id="fotopetugas" class="form-control rounded-1">
                            @error('fotopetugas')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="namapetugas" class="fw-bold text-primary">Nama Petugas</label>
                            <input type="text" name="namapetugas" id="namapetugas" value="{{ old('namapetugas') }}" class="form-control rounded-1">
                            @error('namapetugas')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jeniskelamin" class="fw-bold text-primary">Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jeniskelamin" id="jeniskelaminP" value="P" {{ old('jeniskelamin') == 'P' ? 'checked' : '' }}>
                                <label class="form-check-label" for="jeniskelaminP">Perempuan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jeniskelamin" id="jeniskelaminL" value="L" {{ old('jeniskelamin') == 'L' ? 'checked' : '' }}>
                                <label class="form-check-label" for="jeniskelaminL">Laki-Laki</label>
                            </div>
                            @error('jeniskelamin')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="fw-bold text-primary">Alamat</label>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" class="form-control rounded-1">
                            @error('alamat')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="notelp" class="fw-bold text-primary">No Telephone</label>
                            <input type="text" name="notelp" id="notelp" value="{{ old('notelp') }}" class="form-control rounded-1">
                            @error('notelp')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="fw-bold text-primary">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control rounded-1">
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