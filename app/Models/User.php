<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'is_admin',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    // Relasi: user bisa membuat banyak peminjaman (sebagai inputter)
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'user_id_input');
    }

    // Relasi: user memverifikasi pembayaran
    public function verifikasiPembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'user_id_verifikasi');
    }

    // Relasi: user mencatat riwayat
    public function riwayatPeminjaman()
    {
        return $this->hasMany(RiwayatPeminjaman::class, 'user_id');
    }
}