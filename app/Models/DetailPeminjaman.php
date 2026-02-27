<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'peminjaman_id', 'barang_id', 'jumlah_barang',
        'harga_sewa_per_unit', 'subtotal_sewa'
    ];

    protected $casts = [
        'harga_sewa_per_unit' => 'decimal:2',
        'subtotal_sewa' => 'decimal:2',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}