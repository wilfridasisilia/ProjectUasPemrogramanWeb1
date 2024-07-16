<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->uuid('idpeminjaman');
            $table->primary('idpeminjaman');
            $table->uuid('idbuku');
            $table->foreign('idbuku')->references('idbuku')->on('buku');
            $table->uuid('idpetugas');
            $table->foreign('idpetugas')->references('idpetugas')->on('petugas');
            $table->uuid('idmahasiswa');
            $table->foreign('idmahasiswa')->references('idmahasiswa')->on('mahasiswas');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->enum('status', ['Dipinjam', 'Tersedia']);
            $table->timestamps();
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
