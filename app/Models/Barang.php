<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
<<<<<<< HEAD
    protected $primaryKey = 'id_item';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nama_barang',
        'id_kategori',
        'deskripsi',
        'lokasi_temuan',
        'tanggal_temuan',
        'status',       // Berisi 'hilang' atau 'temuan'
        'status_admin', // Kolom baru yang kamu buat di phpMyAdmin
        'foto_barang',
    ];
=======
protected $primaryKey = 'id_item';
protected $fillable = ['id_kategori', 'nama_barang', 'deskripsi', 'status']; 
>>>>>>> fitur-filter
}
