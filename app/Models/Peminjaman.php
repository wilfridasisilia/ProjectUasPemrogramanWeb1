<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'peminjaman';
    protected $primaryKey = 'idpeminjaman'; 

    protected $fillable = [
        'idpeminjaman',
        'idbuku',
        'idpetugas',
        'idmahasiswa',
        'tgl_pinjam',
        'tgl_kembali',
        'status',
    ];


    public function buku() {
        return $this->belongsTo(Buku::class, 'idbuku');
    }

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class,'idmahasiswa');
    }

    public function petugas() {
        return $this->belongsTo(Petugas::class,'idpetugas');
    }
}

