<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe_peminjam', ['internal', 'eksternal']);
            $table->foreignId('user_id_input')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nama_peminjam');
            $table->string('nim_peminjam')->nullable();
            $table->string('jabatan_peminjam')->nullable();
            $table->string('instansi_peminjam');
            $table->string('kontak_peminjam');
            $table->string('email_peminjam')->nullable();
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->date('tanggal_pengembalian_aktual')->nullable();
            $table->integer('durasi_hari')->nullable(); // akan dihitung dan diisi
            $table->text('catatan')->nullable();
            $table->enum('status_peminjaman', [
                'pending', 'disetujui', 'ditolak', 'ongoing', 'dikembalikan', 'terlambat'
            ])->default('pending');
            $table->string('nomor_surat_internal')->nullable();
            $table->string('nomor_surat_eksternal')->nullable();
            $table->string('file_surat')->nullable();
            $table->decimal('biaya_sewa_total', 15, 2)->default(0);
            $table->enum('status_pembayaran', ['belum_lunas', 'lunas', 'pending'])->default('belum_lunas');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};