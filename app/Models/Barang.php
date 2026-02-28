<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'barang';

    protected $fillable = [
        'nama_barang', 'pemilik_barang', 'deskripsi_barang', 'kategori_id',
        'jumlah_total', 'jumlah_tersedia', 'kondisi_barang',
        'gambar_barang', 'dapat_disewa', 'harga_sewa_per_hari'
    ];

    protected $casts = [
        'dapat_disewa' => 'boolean',
        'harga_sewa_per_hari' => 'decimal:2',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'barang_id');
    }
}