@extends('Layout.main')
@section('title', 'Daftar Mahasiswa')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Daftar Mahasiswa</h1>
    <p class="mb-4">Ini merupakan daftar Mahasiswa Universitas Multi Data Palembang</p>
   
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="align-middle text-primary text-center">NPM</th>
                            <th class="align-middle text-primary text-center">Nama</th>
                            <th class="align-middle text-primary text-center">Jenis Kelamin</th>
                            <th class="align-middle text-primary text-center">Foto</th>
                            @can('viewAny', App\Models\Mahasiswa::class)
                            <th class="align-middle text-primary text-center">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswa as $item)
                        <tr class="{{ request('search') && (
                                stripos($item->nama, request('search')) !== false ||
                                stripos($item->npm, request('search')) !== false ||
                                stripos($item->jeniskelamin, request('search')) !== false) ? 'table-primary' : '' }}">
                            <td class="align-middle text-center">{{ $item->npm }}</td>
                            <td class="align-middle text-center">{{ $item->nama }}</td>
                            <td class="align-middle text-center"> 
                                @if($item->jeniskelamin === 'L') Laki-laki 
                                @else Perempuan 
                                @endif
                            </td>
                            <td class="align-middle text-center"><img src="{{ url('foto/'.$item->url_foto) }}" class=" rounded mx-auto d-block" style="max-width: 80px; max-height: 80px;"></td>
                            @can('delete', $item)
                            <td class="align-middle text-center"><form action="{{ route('mahasiswa.destroy', $item->idmahasiswa) }}" method="post" style="display: inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger show_confirm" data-toggle="tooltip" data-nama="{{ $item['nama'] }}" title="hapus">Hapus</button>
                              </form>
                            @endcan
                            @can('update', $item)
                              <a href="{{ route('mahasiswa.edit', $item['idmahasiswa']) }}" class="btn btn-warning mx-1">Edit</a>
                            @endcan
                            @can('view', $item)
                              <a href="{{ route('mahasiswa.show', $item['idmahasiswa']) }}" class="btn btn-info">Detail</a>
                            @endcan
                            </td>
                        </tr>   
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
       </div>
       @can('create', App\Models\Mahasiswa::class)
       <a href="{{ url('mahasiswa/create') }}" class="btn btn-success btn-rounded btn-fw">Tambah</a>
        @endcan
   </div>
   @endsection
   