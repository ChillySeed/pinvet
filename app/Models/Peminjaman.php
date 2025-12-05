<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'tipe_peminjaman',
        'id_user_input',
        'nama_peminjam',
        'nim_peminjam',
        'jabatan_peminjam',
        'instansi_peminjam',
        'kontak_peminjam',
        'email_peminjam',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_pengembalian_aktual',
        'durasi_hari',
        'catatan',
        'status_peminjaman',
        'nomor_surat',
        'file_surat',
        'biaya_sewa_total',
        'status_pembayaran',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
        'tanggal_pengembalian_aktual' => 'date',
        'biaya_sewa_total' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user_input');
    }

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_peminjaman');
    }

    public function riwayat()
    {
        return $this->hasMany(RiwayatPeminjaman::class, 'id_peminjaman');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_peminjaman');
    }

    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'detail_peminjaman', 'id_peminjaman', 'id_barang')
                    ->withPivot('jumlah_barang', 'harga_sewa_per_unit', 'subtotal_sewa');
    }
}