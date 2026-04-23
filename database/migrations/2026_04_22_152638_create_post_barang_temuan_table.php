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
        // Pake huruf kecil semua biar sinkron sama Model & Database
        Schema::create('post_barang_temuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->string('item_name');          
            $table->text('description');         
            $table->string('location');          
            $table->date('found_date');          
            $table->string('image')->nullable(); 
            $table->timestamps();                
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_barang_temuan');
    }
};