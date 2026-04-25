<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostBarangTemuan extends Model
{
    use HasFactory;

    // REVISI: Gunakan huruf kecil semua sesuai standar database lu tadi
    // Kalau tadi lu buat migrasinya 'post_barang_temuan', pake yang itu.
    protected $table = 'post_barang_temuan'; 

    protected $fillable = [
        'user_id',
        'item_name',
        'description',
        'location',
        'found_date',
        'image',
    ];
}