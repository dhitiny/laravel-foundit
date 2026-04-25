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
    Schema::create('post_barang_hilang', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('item_name');
        $table->text('description');
        $table->string('location');
        $table->date('lost_date'); // Pake lost_date biar beda sama temuan
        $table->string('image')->nullable();
        $table->timestamps();
    });
}
};
