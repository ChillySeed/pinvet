<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'peminjaman_id', 'user_id_verifikasi', 'jumlah_bayar', 'metode_pembayaran',
        'tanggal_bayar', 'bukti_pembayaran', 'status_verifikasi', 'catatan'
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
        'jumlah_bayar' => 'decimal:2',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'user_id_verifikasi');
    }
}