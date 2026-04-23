<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
protected $primaryKey = 'id_item';
protected $fillable = ['id_kategori', 'nama_barang', 'deskripsi', 'status']; 
}
