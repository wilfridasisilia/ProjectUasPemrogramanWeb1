<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Lama Peminjaman
        $lamapeminjaman = DB::select("
        SELECT m.nama, b.judul, DATEDIFF(p.tgl_kembali, p.tgl_pinjam) AS lama_peminjaman 
        FROM peminjaman p 
        JOIN mahasiswas m ON p.idmahasiswa = m.idmahasiswa 
        JOIN buku b ON p.idbuku = b.idbuku
        GROUP BY m.nama, b.judul, p.tgl_kembali, p.tgl_pinjam");
        
        $peminjamanmhs = DB::select("
        SELECT buku.judul, COUNT(*) AS jumlah 
        FROM peminjaman 
        JOIN buku ON peminjaman.idbuku = buku.idbuku
        GROUP BY buku.judul");

        // Total Peminjaman per Bulan
        $totalPeminjaman = DB::table('peminjaman')->count();

        // Total Petugas
        $totalPetugas = DB::table('petugas')->count();

        // Total Buku
        $totalBuku = DB::table('buku')->count();

        // Total Mahasiswa
        $totalMahasiswa = DB::table('mahasiswas')->count();

        // Status Peminjaman
        $statusPeminjaman = DB::table('peminjaman')
        ->select('status', DB::raw('count(*) as jumlah'))
        ->groupBy('status')
        ->get();
        
        // 3 peminjaman terbaru
        $peminjamanTerbaru = DB::table('peminjaman')
        ->join('mahasiswas', 'peminjaman.idmahasiswa', '=', 'mahasiswas.idmahasiswa')
        ->join('buku', 'peminjaman.idbuku', '=', 'buku.idbuku')
        ->select('mahasiswas.nama as mahasiswa', 'buku.judul as buku', 'peminjaman.tgl_pinjam')
        ->orderBy('peminjaman.tgl_pinjam', 'desc')
        ->limit(3)
        ->get();

        return view('dashboard', [
            'peminjamanmhs' => $peminjamanmhs,
            'totalPeminjaman' => $totalPeminjaman,
            'totalPetugas' => $totalPetugas,
            'totalBuku' => $totalBuku,
            'totalMahasiswa' => $totalMahasiswa,
            'statusPeminjaman' => $statusPeminjaman,
            'lamapeminjaman' => $lamapeminjaman,
            'peminjamanTerbaru' => $peminjamanTerbaru
        ]);
    }
}
