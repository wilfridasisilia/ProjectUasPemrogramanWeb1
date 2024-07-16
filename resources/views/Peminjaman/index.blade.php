@extends('Layout.main')

@section('title', 'Data Peminjaman')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Peminjaman</h1>
    <p class="mb-4">Ini merupakan data peminjaman buku di Universitas Multi Data Palembang</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Peminjaman</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="align-middle text-primary text-center">Judul Buku</th>
                            <th class="align-middle text-primary text-center">Nama Mahasiswa</th>
                            <th class="align-middle text-primary text-center">Status</th>
                            @can('viewAny', App\Models\Peminjaman::class)
                            <th class="align-middle text-primary text-center">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman as $item)
                        <tr class="{{ request('search') && (
                                    stripos($item->buku->judul, request('search')) !== false ||
                                    stripos($item->mahasiswa->nama, request('search')) !== false ||
                                    stripos($item->status, request('search')) !== false) ? 'table-primary' : '' }}">
                            <td class="align-middle text-center">{{ $item->buku->judul }}</td>
                            <td class="align-middle text-center">{{ $item->mahasiswa->nama }}</td>
                            <td class="align-middle text-center">{{ $item->status }}</td>
                            @can('delete', $item)
                            <td class="align-middle text-center">
                                <form action="{{ route('peminjaman.destroy', $item->idpeminjaman) }}" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-rounded btn-fw show_confirm" data-toggle="tooltip" data-nama="{{ $item['nama'] }}" title="hapus">Hapus</button>
                                </form>
                                @endcan
                                @can('update', $item)
                                <a href="{{ route('peminjaman.edit', $item->idpeminjaman) }}" class="btn btn-warning my-1">Edit</a>
                                @endcan
                                @can('view', $item)
                                <a href="{{ route('peminjaman.show', $item->idpeminjaman) }}" class="btn btn-info">Detail</a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@can('create', App\Models\Peminjaman::class)
    <a href="{{ route('peminjaman.create') }}" class="btn btn-success btn-rounded btn-fw">Tambah</a>
@endcan
</div>
@endsection
