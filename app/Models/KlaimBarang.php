<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlaimBarang extends Model
{
    use HasFactory;

    // 1. KUNCI NAMA TABEL: Biar Laravel gak nyari 'klaim_barangs' (pakai akhiran s)
    protected $table = 'klaim_barang';

    // 2. MASS ASSIGNMENT: Daftarkan semua kolom yang boleh diisi lewat Controller
    protected $fillable = [
        'barang_id',   // Menyimpan ID Item dari tabel barang
        'user_id',     // Menyimpan ID User yang mengajukan klaim
        'ciri_khusus',
        'bukti_foto',
        'status',      // Aman untuk string biasa maupun ENUM ('PENDING', 'APPROVED', etc.)
    ];

    /**
     * Relasi balik ke Model Barang
     * Digunakan untuk tahu barang apa yang sedang diklaim le.
     */
    public function barang()
    {
        // Target foreign key dikunci ke 'barang_id', dan primary key di tabel barang adalah 'id_item'
        return $this->belongsTo(Barang::class, 'barang_id', 'id_item');
    }

    /**
     * Relasi ke Model User
     * Digunakan untuk tahu siapa akun yang mengajukan klaim ini.
     */
    public function user()
    {
        // Target foreign key dikunci ke 'user_id', dan primary key di tabel users adalah 'id_user'
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
}
