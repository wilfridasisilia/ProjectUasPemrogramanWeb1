@extends('Layout.main')

@section('title', 'Detail Petugas')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-lg-8">
      <div class="card mx-auto">
        <div class="card-body">
          <h4 class="card-title fw-bold text-primary">Detail Petugas</h4>
          <p class="card-description">Informasi lengkap tentang petugas</p>
          <div class="table-responsive">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <th scope="row" class="text-primary">Foto Petugas</th>
                  <td><img src="{{ url('foto/' . $petugas->fotopetugas) }}" alt="Foto Petugas" class="rounded mx-auto d-block" style="max-width: 150px; max-height: 100px;"></td>
                </tr>
                <tr>
                  <th scope="row" class="text-primary">Nama Petugas</th>
                  <td>{{ $petugas->namapetugas }}</td>
                </tr>
                <tr>
                  <th scope="row" class="text-primary">Jenis Kelamin</th>
                  <td>
                    @if ($petugas->jeniskelamin === 'P')
                      Perempuan
                    @elseif ($petugas->jeniskelamin === 'L')
                      Laki-Laki
                    @else
                      Jenis Kelamin Tidak Diketahui
                    @endif
                  </td>
                </tr>
                <tr>
                  <th scope="row" class="text-primary">No Telephone</th>
                  <td>{{ $petugas->notelp }}</td>
                </tr>
                <tr>
                  <th scope="row" class="text-primary">Email</th>
                  <td>{{ $petugas->email }}</td>
                </tr>
                <tr>
                  <th scope="row" class="text-primary">Alamat</th>
                  <td>{{ $petugas->alamat }}</td>
                </tr>
              </tbody>
            </table>
            <div class="text-start mt-4">
              <a href="{{ url('petugas') }}">
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
