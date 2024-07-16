@extends('Layout.main')

@section('title', 'Daftar Buku')

@section('content') 
<div class="container-fluid">
 <h1 class="h3 mb-2 text-gray-800">Daftar Buku</h1>
 <p class="mb-4">Ini merupakan daftar buku perpustakaan Universitas Multi Data Palembang</p>

 <div class="card shadow mb-4">
     <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">Data Buku</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr>   
                         <th class="align-middle text-primary text-center">Judul</th>
                         <th class="align-middle text-primary text-center">Pengarang</th>
                         <th class="align-middle text-primary text-center">Penerbit</th>
                         <th class="align-middle text-primary text-center">Tahun Terbit</th> 
                         <th class="align-middle text-primary text-center">Stok</th>
                         <th class="align-middle text-primary text-center">Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($buku as $item)
                        <tr class="{{ request('search') && (
                            stripos($item->judul, request('search')) !== false ||
                            stripos($item->pengarang, request('search')) !== false ||
                            stripos($item->penerbit, request('search')) !== false ||
                            stripos($item->tahunterbit, request('search')) !== false ||
                            stripos($item->stok, request('search')) !== false) ? 'table-primary' : '' }}">
                            
                         <td class="align-middle text-center">{{ $item->judul }}</td>
                         <td class="align-middle text-center">{{ $item->pengarang }}</td>
                         <td class="align-middle text-center">{{ $item->penerbit }}</td>
                         <td class="align-middle text-center">{{ $item->tahunterbit }}</td>
                         <td class="align-middle text-center">{{ $item->stok }}</td>
                            
                         <td class="align-middle text-center">
                             <div class="d-flex justify-content-center">
                                @can('delete', $item)
                                 <form action="{{ route('buku.destroy', $item->idbuku) }}" method="post" style="display: inline">
                                     @method('DELETE')
                                     @csrf
                                     <button type="submit" class="btn btn-danger btn-rounded btn-fw show_confirm" data-toggle="tooltip" data-nama="{{ $item['nama'] }}" title="hapus">Hapus</button>
                                 </form>
                                @endcan
                                @can('update', $item)
                                 <a href="{{ route('buku.edit', $item->idbuku) }}" class="btn btn-warning btn-rounded btn-fw ml-2">Edit</a>  
                                @endcan
                                 <a href="{{ route('buku.show', $item->idbuku) }}" class="btn btn-info btn-fw ml-2">Detail</a>
                             </div>
                         </td>
                        </tr>   
                     @endforeach
                 </tbody>
             </table>
         </div>
     </div>
    </div>
    @can('create', App\Models\Buku::class )
    <a href="{{ url('buku/create') }}" class="btn btn-success btn-rounded btn-fw">Tambah</a>
    @endcan
</div>
@endsection
