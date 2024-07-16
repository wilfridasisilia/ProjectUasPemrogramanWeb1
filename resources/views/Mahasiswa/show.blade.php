@extends('Layout.main')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-lg-8">
      <div class="card mx-auto">
        <div class="card-body">
          <h4 class="card-title fw-bold text-primary">Detail Mahasiswa</h4>
          <p class="card-description">Informasi lengkap tentang mahasiswa</p>
          <div class="table-responsive">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <th scope="row" class="text-primary">NPM</th>
                  <td>{{ $mahasiswa->npm }}</td>
                </tr>
                <tr>
                  <th scope="row" class="text-primary" style="width: 30%;">Nama Mahasiswa</th>
                  <td>{{ $mahasiswa->nama }}</td>
                </tr>
                <tr>
                  <th scope="row" class="text-primary">Alamat</th>
                  <td>{{ $mahasiswa->alamat }}</td>
                </tr>
                <tr>
                  <th scope="row" class="text-primary">Jenis Kelamin</th>
                  <td>
                    @if ($mahasiswa->jeniskelamin === 'P')
                      Perempuan
                    @elseif ($mahasiswa->jeniskelamin === 'L')
                      Laki-Laki
                    @else
                      Jenis Kelamin Tidak Diketahui
                    @endif
                  </td>
                </tr>
                <tr>
                  <th scope="row" class="text-primary">Foto</th>
                  <td><img src="{{ url('foto/'.$mahasiswa->url_foto) }}" class="rounded mx-auto d-block" style="max-width: 150px; max-height: 100px;"></td>
                </tr>
              </tbody>
            </table>
            <div class="text-start mt-4">
              <a href="{{ url('mahasiswa') }}">
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
