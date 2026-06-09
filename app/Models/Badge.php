<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $table = 'badges';

    // Sesuaikan primary key-nya jika di phpMyAdmin bukan 'id' (misal: 'id_badge')
    protected $primaryKey = 'id';

    // 🚀 SUNTIKAN: Tambahkan 'id_user' ke dalam fillable agar Laravel mengizinkan
    // penyimpanan ID user langsung di tabel ini tanpa error mass-assignment
    protected $fillable = [
        'nama_badge',
        'deskripsi',
        'logo_badge',
    ];

    /**
     * Relasi ke model User diubah menjadi BelongsTo (Satu data badge di tabel ini dimiliki oleh satu user).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
