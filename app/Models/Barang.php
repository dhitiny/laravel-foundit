<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_item';
    public $timestamps = false; // Jika nanti ingin pakai created_at/updated_at bawaan, ini bisa diubah jadi true

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

    // Diubah ke datetime supaya jamnya ikut terbaca
    protected $casts = [
        'tanggal_kejadian' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
