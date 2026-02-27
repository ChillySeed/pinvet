<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('peminjaman')->onDelete('cascade');
            $table->foreignId('user_id_verifikasi')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('jumlah_bayar', 15, 2);
            $table->string('metode_pembayaran'); // tunai, transfer, dll
            $table->date('tanggal_bayar');
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status_verifikasi', ['pending', 'verified', 'rejected'])->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};