<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('petugas', function (Blueprint $table) {
            $table->string('notelp')->unique()->after('alamat');
            $table->string('email')->unique()->after('notelp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('petugas', function (Blueprint $table) {
            $table->dropColumn('notelp');
            $table->dropColumn('email');
        });
    }
};
