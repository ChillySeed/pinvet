<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username',
        'nama_pengurus',
        'nim_pengurus',
        'email_pengurus',
        'alamat_pengurus',
        'password',
        'level_akses',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_user_input');
    }

    public function riwayat()
    {
        return $this->hasMany(RiwayatPeminjaman::class, 'id_user');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_user_verifikasi');
    }
}
