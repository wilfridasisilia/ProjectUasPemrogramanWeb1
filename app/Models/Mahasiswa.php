<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'mahasiswas';

    protected $primaryKey = 'idmahasiswa';

    protected $fillable = [
        'npm',
        'nama',
        'alamat',
        'jeniskelamin',
        'url_foto'
    ];

    
}
