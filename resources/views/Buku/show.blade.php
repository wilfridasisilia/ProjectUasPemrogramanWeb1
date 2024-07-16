@extends('Layout.main')

@section('title', 'Detail Buku')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-lg-8">
      <div class="card mx-auto">
        <div class="card-body">
          <h4 class="card-title fw-bold text-primary">Detail Buku</h4>
          <p class="card-description">Informasi lengkap tentang Buku</p>
          <div class="table-responsive">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <th scope="row" class="text-primary" style="width: 30%;">Judul</th>
                  <td>{{ $buku->judul }}</td>
                </tr>
                <tr>
                  <th scope="row" class="text-primary">Sinopsis</th>
                  <td>{{ $buku->sinopsis }}</td>
                </tr>
                <tr>
                  <th scope="row" class="text-primary">Nama Pengarang</th>
                  <td>{{ $buku->pengarang }}</td>
                </tr>
                <tr>
                  <th scope="row" class="text-primary">Nama Penerbit</th>
                  <td>{{ $buku->penerbit }}</td>
                </tr>
                <tr>
                    <th scope="row" class="text-primary">Tahun Terbit</th>
                    <td>{{ $buku->tahunterbit }}</td>
                  </tr>
                  <tr>
                    <th scope="row" class="text-primary">Kategori</th>
                    <td>{{ $buku->kategori }}</td>
                  </tr>
                  <tr>
                    <th scope="row" class="text-primary">Stok</th>
                    <td>{{ $buku->stok }}</td>
                  </tr>
              </tbody>
            </table>
            <div class="text-start mt-4">
              <a href="{{ url('buku') }}">
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
