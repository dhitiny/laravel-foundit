<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_item';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nama_barang',
        'id_kategori',
        'deskripsi',
        'lokasi_temuan',
        'tanggal_temuan',
        'status',       
        'status_admin', 
        'foto_barang',
    ];

}
