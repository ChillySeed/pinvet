<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peminjaman extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tipe_peminjam', 'user_id_input', 'nama_peminjam', 'nim_peminjam',
        'jabatan_peminjam', 'instansi_peminjam', 'kontak_peminjam', 'email_peminjam',
        'tanggal_pinjam', 'tanggal_kembali', 'tanggal_pengembalian_aktual',
        'durasi_hari', 'catatan', 'status_peminjaman',
        'nomor_surat_internal', 'nomor_surat_eksternal', 'file_surat',
        'biaya_sewa_total', 'status_pembayaran'
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
        'tanggal_pengembalian_aktual' => 'date',
        'biaya_sewa_total' => 'decimal:2',
    ];

    // Relasi ke user yang input (admin)
    public function inputBy()
    {
        return $this->belongsTo(User::class, 'user_id_input');
    }

    // Relasi ke detail barang
    public function details()
    {
        return $this->hasMany(DetailPeminjaman::class, 'peminjaman_id');
    }

    // Relasi ke riwayat
    public function riwayat()
    {
        return $this->hasMany(RiwayatPeminjaman::class, 'peminjaman_id');
    }

    // Relasi ke pembayaran
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'peminjaman_id');
    }

    // Accessor: nomor surat yang tampil (prioritas eksternal)
    public function getNomorSuratAttribute()
    {
        return $this->nomor_surat_eksternal ?? $this->nomor_surat_internal;
    }
}