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
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_barang');
            $table->string('nama_barang', 255);
            $table->string('pemilik_barang', 255)->default('UKM');
            $table->text('deskripsi_barang')->nullable();
            $table->string('kategori_barang', 100);
            $table->unsignedInteger('jumlah_total');
            $table->unsignedInteger('jumlah_tersedia');
            $table->enum('kondisi_barang', ['baik', 'rusak_ringan', 'rusak_berat'])->default('baik');
            $table->string('lokasi_penyimpanan', 255);
            $table->string('gambar_barang', 500)->nullable();
            $table->boolean('dapat_disewa')->default(false);
            $table->decimal('harga_sewa_per_hari', 15, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
