@extends('Layout.main')
@section('title', 'Tambah Buku')

@section('content')
<div class="container-fluid px-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card rounded-3">
                <div class="card-body">
                    <h4 class="card-title text-primary">Tambah Buku</h4>
                    <p class="card-description">
                        Formulir Tambah Buku
                    </p>
                    <form class="forms-sample" action="{{ route('buku.store') }}" method="post" autocomplete="off" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="judul" class="fw-bold text-primary">Judul Buku</label>
                            <input type="text" class="form-control rounded-1" name="judul" id="judul" value="{{ old('judul') }}">
                            @error('judul')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sinopsis" class="fw-bold text-primary">Sinopsis</label>
                            <textarea class="form-control rounded-1" name="sinopsis" id="sinopsis" value="{{ old('sinopsis') }}"></textarea>
                            @error('sinopsis')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pengarang" class="fw-bold text-primary">Nama Pengarang</label>
                            <input type="text" class="form-control rounded-1" name="pengarang" id="pengarang" value="{{ old('pengarang') }}">
                            @error('pengarang')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="penerbit" class="fw-bold text-primary">Nama Penerbit</label>
                            <input type="text" class="form-control rounded-1" name="penerbit" id="penerbit" value="{{ old('penerbit') }}">
                            @error('penerbit')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tahunterbit" class="fw-bold text-primary">Tahun Terbit</label>
                            <input type="year" class="form-control rounded-1" maxlength="4" name="tahunterbit" id="tahunterbit" value="{{ old('tahunterbit') }}">
                            @error('tahunterbit')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kategori" class="fw-bold text-primary">Kategori</label>
                            <input type="text" class="form-control rounded-1" name="kategori" id="kategori" value="{{ old('kategori') }}">
                            @error('kategori')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stok" class="fw-bold text-primary">Stok</label>
                            <input type="text" class="form-control rounded-1" name="stok" id="stok" value="{{ old('stok') }}">
                            @error('stok')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ url('buku') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection