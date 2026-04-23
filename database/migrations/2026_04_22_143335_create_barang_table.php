<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_item');
            $table->foreignId('id_user');
            $table->string('nama_barang');
            $table->string('kategori');
            $table->text('deskripsi');
            $table->string('lokasi');
            $table->date('tanggal_kejadian');
            $table->string('foto_barang')->nullable();
            $table->enum('jenis_barang', ['hilang', 'temuan']);
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
