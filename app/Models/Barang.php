<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $primaryKey = 'id_item';

    protected $fillable = [
        'id_user',
        'id_kategori',
        'nama_barang',
        'deskripsi',
        'foto_barang',
        'lokasi_temuan',
        'tanggal_temuan',
        'status',
        'cp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
