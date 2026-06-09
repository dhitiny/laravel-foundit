<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('klaim_barang', function (Blueprint $table) {
            $table->id();

            // REVISI: Ubah 'barangs' menjadi 'barang' sesuai isi phpMyAdmin lu
            $table->foreignId('barang_id')->constrained('barang', 'id_item')->onDelete('cascade');
            // Pastikan parameter kedua dikunci ke 'id_user' sesuai dengan primary key tabel users kamu le!
            $table->foreignId('user_id')->constrained('users', 'id_user')->onDelete('cascade');
            $table->text('ciri_khusus');
            $table->string('bukti_foto')->nullable();
            $table->enum('status', ['PENDING', 'APPROVED', 'REJECTED'])->default('PENDING');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('klaim_barangs');
    }
};
