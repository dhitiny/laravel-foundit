<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; // 🚀 Tambahkan import ini

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'users';

    // Tegaskan primary key tabel users adalah id_user
    protected $primaryKey = 'id_user';

    // Jika id_user di phpMyAdmin bertipe AI (Auto Increment) / Integer
    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'username',
        'email',
        'password',
        'whatsapp',
        'foto_profil',
        'role',
        'status',
    ];

    /**
     * 🚀 SUNTIKAN RELASI MANY-TO-MANY KE BADGE
     * Menghubungkan user dengan badge melalui tabel pivot 'badge_user'.
     */
    /**
     * Mengubah relasi menjadi HasMany (Satu user punya banyak data badge langsung).
     */
    public function badges()
    {
        // 'id_user' di sini adalah nama kolom foreign key yang ada di tabel badges kamu
        return $this->hasMany(Badge::class, 'id_user', 'id_user');
    }

    // ... sisa kode casts dan hidden di bawahnya dibiarkan saja ya bubb
}
