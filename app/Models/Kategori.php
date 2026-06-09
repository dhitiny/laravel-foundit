<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    // WAJIB DITULIS: Kasih tahu Laravel kalau primary key lu bukan 'id' tapi 'id_kategori'
    protected $primaryKey = 'id_kategori';

    protected $fillable = ['nama_kategori'];
}
