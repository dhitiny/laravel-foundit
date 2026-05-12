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
        'kategori',
        'deskripsi',
        'lokasi',
        'tanggal_kejadian',
        'foto_barang',
        'jenis_barang',
        'status',
    ];

    // Ini diletakkan di luar fillable
    protected $casts = [
        'tanggal_kejadian' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
