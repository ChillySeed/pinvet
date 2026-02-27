<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('peminjaman')->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barang')->onDelete('restrict');
            $table->unsignedInteger('jumlah_barang');
            $table->decimal('harga_sewa_per_unit', 15, 2)->default(0);
            $table->decimal('subtotal_sewa', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_peminjaman');
    }
};