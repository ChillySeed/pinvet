<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'nama_barang',
        'pemilik_barang',
        'deskripsi_barang',
        'kategori_barang',
        'jumlah_total',
        'jumlah_tersedia',
        'kondisi_barang',
        'lokasi_penyimpanan',
        'gambar_barang',
        'dapat_disewa',
        'harga_sewa_per_hari',
    ];

    protected $casts = [
        'dapat_disewa' => 'boolean',
        'harga_sewa_per_hari' => 'decimal:2',
    ];

    // Relationships
    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_barang');
    }
}