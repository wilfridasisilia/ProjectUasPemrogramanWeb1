@extends('Layout.main')

@section('title', 'Edit Peminjaman')

@section('content')
<div class="container-fluid px-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card rounded-3">
                <div class="card-body">
                    <h4 class="card-title fw-bold text-primary">Edit Peminjaman</h4>
                    <p class="card-description">
                        Formulir Edit Peminjaman
                    </p>
                    <form class="forms-sample" action="{{ route('peminjaman.update', $peminjaman['idpeminjaman']) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="idbuku" class="fw-bold text-primary">Judul Buku</label>
                            <select name="idbuku" id="idbuku" class="form-control" required>
                                <option value="">Pilih Buku</option>
                                @foreach ($buku as $item)
                                    <option value="{{ $item['idbuku'] }}" {{ $item['idbuku'] == old('idbuku', $peminjaman['idbuku']) ? 'selected' : '' }}>{{ $item['judul'] }}</option>
                                @endforeach
                            </select>
                            @error('idbuku')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="idmahasiswa" class="fw-bold text-primary">Nama Mahasiswa</label>
                            <select name="idmahasiswa" id="idmahasiswa" class="form-control" required>
                                <option value="">Pilih Mahasiswa</option>
                                @foreach ($mahasiswa as $item)
                                    <option value="{{$item['idmahasiswa']}}" {{ $item['idmahasiswa'] == old('idmahasiswa', $peminjaman['idmahasiswa']) ? 'selected' : '' }}>{{ $item['nama'] }}</option>
                                @endforeach
                            </select>
                            @error('idmahasiswa')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="idpetugas" class="fw-bold text-primary">Nama Petugas</label>
                            <select name="idpetugas" id="idpetugas" class="form-control" required>
                                <option value="">Pilih Petugas</option>
                                @foreach ($petugas as $item)
                                    <option value="{{ $item['idpetugas'] }}" {{ $item['idpetugas'] == old('idpetugas', $peminjaman['idpetugas']) ? 'selected' : '' }}>{{ $item['namapetugas'] }}</option>
                                @endforeach
                            </select>
                            @error('idpetugas')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tgl_pinjam" class="fw-bold text-primary">Tanggal Pinjam</label>
                            <input type="date" name="tgl_pinjam" id="tgl_pinjam" value="{{ old('tgl_pinjam', $peminjaman['tgl_pinjam']) }}" class="form-control" required>
                            @error('tgl_pinjam')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tgl_kembali" class="fw-bold text-primary">Tanggal Kembali</label>
                            <input type="date" name="tgl_kembali" id="tgl_kembali" value="{{ old('tgl_kembali', $peminjaman['tgl_kembali']) }}" class="form-control" required>
                            @error('tgl_kembali')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status" class="fw-bold text-primary">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="Dipinjam" {{ old('status', $peminjaman['status']) == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="Tersedia" {{ old('status', $peminjaman['status']) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ url('peminjaman') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
