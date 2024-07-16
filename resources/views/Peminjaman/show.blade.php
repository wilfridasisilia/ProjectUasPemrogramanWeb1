@extends('Layout.main')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-lg-8">
      <div class="card mx-auto">
        <div class="card-body">
          <h4 class="card-title fw-bold text-primary">Detail Peminjaman</h4>
          <p class="card-description">Informasi lengkap tentang Peminjaman Buku</p>
          <div class="table-responsive">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <th scope="row" class="text-primary">Judul Buku</th>
                  <td>{{ $peminjaman->buku->judul }}</td>
                </tr>
                <tr>
                  <th scope="row" class="text-primary">Nama Mahasiswa</th>
                  <td>{{ $peminjaman->mahasiswa->nama }}</td>
                </tr>
                <tr>
                  <th scope="row" class="text-primary">Nama Petugas</th>
                  <td>{{ $peminjaman->petugas->namapetugas }}</td>
                </tr>
                <tr>
                  <th scope="row" class="text-primary">Tanggal Pinjam</th>
                  <td>{{ $peminjaman->tgl_pinjam }}</td>
                </tr>
                <tr>
                    <th scope="row" class="text-primary">Tanggal Kembali</th>
                    <td>{{ $peminjaman->tgl_kembali }}</td>
                  </tr>
                <tr>
                    <th scope="row" class="text-primary">Status</th>
                    <td>{{ $peminjaman->status }}</td>
                </tr>
              </tbody>
            </table>
            <div class="text-start mt-4">
              <a href="{{ url('peminjaman') }}">
                <img src="{{ url('img/undo.png') }}" alt="Back Icon" style="width: 30px; height: 30px; margin-right: 8px;">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
