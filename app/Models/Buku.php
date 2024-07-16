<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'buku';
    
    protected $primaryKey = 'idbuku';

    protected $fillable = [
        'judul',
        'sinopsis',
        'pengarang',
        'penerbit',
        'tahunterbit',
        'kategori',
        'stok'
    ];
}
