<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_item');

            // CUKUP UBAH INI: Tambahkan parameter 'id_user' sebagai target primary key tabel users
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');

            $table->foreignId('id_kategori')->nullable()->constrained('kategori', 'id_kategori')->onDelete('cascade');
            $table->string('nama_barang');
            $table->string('kategori');
            $table->text('deskripsi');
            $table->string('lokasi');
            $table->dateTime('tanggal_kejadian');
            $table->string('foto_barang')->nullable();
            $table->string('jenis_barang');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('barang');
    }
};
