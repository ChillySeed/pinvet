<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('pemilik_barang')->default('UKM');
            $table->text('deskripsi_barang')->nullable();
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('restrict');
            $table->unsignedInteger('jumlah_total');
            $table->unsignedInteger('jumlah_tersedia');
            $table->string('kondisi_barang')->default('baik'); // baik, rusak, etc
            $table->string('lokasi_penyimpanan');
            $table->string('gambar_barang')->nullable();
            $table->boolean('dapat_disewa')->default(false);
            $table->decimal('harga_sewa_per_hari', 15, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();

            // pastikan jumlah_tersedia <= jumlah_total
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};