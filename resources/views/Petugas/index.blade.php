@extends('Layout.main')
@section('title', 'Data Petugas')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Petugas Perpustakaan</h1>
    <p class="mb-4">Ini merupakan data petugas perpustakaan Universitas Multi Data Palembang</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Petugas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="align-middle text-center text-primary">Foto Petugas</th>
                            <th class="align-middle text-center text-primary">Nama Petugas</th>
                            <th class="align-middle text-center text-primary">Jenis Kelamin</th>
                            @can('viewAny', App\Models\Petugas::class)
                            <th class="align-middle text-center text-primary">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($petugas as $item)
                        <tr class="{{ $search && (stripos($item->namapetugas, $search) !== false) ? 'table-primary' : '' }}">
                            <td class="align-middle text-center"><img src="{{ asset('foto/'.$item->fotopetugas) }}" class="rounded mx-auto d-block" style="max-width: 80px; max-height: 80px;"></td>
                            <td class="align-middle text-center">{{ $item->namapetugas }}</td>
                            <td class="align-middle text-center">
                                @if($item->jeniskelamin === 'L')
                                    Laki-laki
                                @else
                                    Perempuan
                                @endif
                            </td>
                            @can('delete', $item)
                            <td class="align-middle text-center">
                                <form action="{{ route('petugas.destroy', $item->idpetugas) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger show_confirm" data-toggle="tooltip" data-nama="{{ $item->nama }}" title="hapus">Hapus</button>
                                </form>
                                @can('update', $item)
                                <a href="{{ route('petugas.edit', $item->idpetugas) }}" class="btn btn-warning mx-1">Edit</a>
                                @endcan
                                @can('view', $item)
                                <a href="{{ route('petugas.show', $item->idpetugas) }}" class="btn btn-info">Detail</a>
                                @endcan
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @can('create', App\Models\Petugas::class)
    <a href="{{ url('petugas/create') }}" class="btn btn-success btn-rounded btn-fw">Tambah</a>
    @endcan
</div>
@endsection
