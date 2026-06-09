<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    protected $table = 'barang';

    // Sesuaikan dengan phpMyAdmin kamu: 'id_item'
    protected $primaryKey = 'id_item';

    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'id_kategori',
        'nama_barang',
        'kategori',
        'deskripsi',
        'lokasi',
        'tanggal_kejadian',
        'foto_barang',
        'jenis_barang',
        'status',
    ];

    protected $casts = [
        'tanggal_kejadian' => 'datetime',
    ];

    // Relasi ke tabel users
    public function user(): BelongsTo
    {
        // Parameter 2: Foreign key di tabel barang ('id_user')
        // Parameter 3: Primary key di tabel users ('id_user')
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
