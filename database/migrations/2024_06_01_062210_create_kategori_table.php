<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kategori', function (Blueprint $table) {
            // Membuat id_kategori sebagai Primary Key otomatis (Auto Increment)
            $table->id('id_kategori');

            // Kolom nama_kategori
            $table->string('nama_kategori');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori');
    }
};
