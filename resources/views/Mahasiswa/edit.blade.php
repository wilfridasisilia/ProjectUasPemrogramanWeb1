@extends('Layout.main')
@section('title', 'Ubah Mahasiswa')

@section('content')
<div class="container-fluid px-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card rounded-3">
                <div class="card-body">
                    <h4 class="card-title text-primary">Ubah Mahasiswa</h4>
                    <p class="card-description">
                        Formulir Ubah Mahasiswa
                    </p>
                    <form class="forms-sample" action="{{ route('mahasiswa.update', $mahasiswa->idmahasiswa)}}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="npm" class="fw-bold text-primary">NPM</label>
                            <input type="text" maxlength="10" name="npm" id="npm" value="{{ old('npm') ? old('npm') : $mahasiswa ->npm}}" class="form-control rounded-1" readonly>
                            @error('npm')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama" class="fw-bold text-primary">Nama Mahasiswa</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama') ? old('nama') : $mahasiswa ->nama}}" class="form-control rounded-1">
                            @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="fw-bold text-primary">Alamat</label>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat') ? old('alamat') : $mahasiswa ->alamat}}" class="form-control rounded-1">
                            @error('alamat')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jeniskelamin" class="fw-bold text-primary">Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jeniskelamin" id="jeniskelaminP" value="P" {{ (old('jeniskelamin') ?? $mahasiswa['jeniskelamin']) == 'P' ? 'checked' : '' }}>
                                <label class="form-check-label" for="jeniskelaminP">Perempuan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jeniskelamin" id="jeniskelaminL" value="L" {{ (old('jeniskelamin') ?? $mahasiswa['jeniskelamin']) == 'L' ? 'checked' : '' }}>
                                <label class="form-check-label" for="jeniskelaminL">Laki-Laki</label>
                            </div>
                            @error('jeniskelamin')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="url_foto" class="fw-bold text-primary">Foto</label>
                            <input type="file" name="url_foto" id="url_foto" class="form-control rounded-1">
                            @error('url_foto')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ url('mahasiswa') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
