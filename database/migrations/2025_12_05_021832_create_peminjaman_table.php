<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id_peminjaman');
            $table->enum('tipe_peminjaman', ['internal', 'eksternal']);
            $table->foreignId('id_user_input')->nullable()->constrained('users', 'id_user')->nullOnDelete();
            $table->string('nama_peminjam', 255);
            $table->string('nim_peminjam', 20)->nullable();
            $table->string('jabatan_peminjam', 100)->nullable();
            $table->string('instansi_peminjam', 255);
            $table->string('kontak_peminjam', 20);
            $table->string('email_peminjam', 255)->nullable();
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->date('tanggal_pengembalian_aktual')->nullable();
            $table->integer('durasi_hari');
            $table->text('catatan')->nullable();
            $table->enum('status_peminjaman', ['pending', 'disetujui', 'ditolak', 'dipinjam', 'dikembalikan', 'terlambat'])->default('pending');
            $table->string('nomor_surat', 100)->unique()->nullable();
            $table->string('file_surat', 500)->nullable();
            $table->decimal('biaya_sewa_total', 15, 2)->default(0.00);
            $table->enum('status_pembayaran', ['lunas', 'belum_lunas', 'dp'])->default('belum_lunas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
