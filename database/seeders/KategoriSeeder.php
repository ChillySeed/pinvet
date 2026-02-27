<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['nama' => 'Elektronik', 'slug' => Str::slug('Elektronik')],
            ['nama' => 'Komputer & Laptop', 'slug' => Str::slug('Komputer & Laptop')],
            ['nama' => 'Kamera & Videografi', 'slug' => Str::slug('Kamera & Videografi')],
            ['nama' => 'Audio & Sound System', 'slug' => Str::slug('Audio & Sound System')],
            ['nama' => 'Alat Tulis Kantor (ATK)', 'slug' => Str::slug('Alat Tulis Kantor ATK')],
            ['nama' => 'Perlengkapan Acara', 'slug' => Str::slug('Perlengkapan Acara')],
            ['nama' => 'Peralatan Olahraga', 'slug' => Str::slug('Peralatan Olahraga')],
            ['nama' => 'Komponen Robotika', 'slug' => Str::slug('Komponen Robotika')],
            ['nama' => 'Alat Praktikum', 'slug' => Str::slug('Alat Praktikum')],
            ['nama' => 'Buku & Literatur', 'slug' => Str::slug('Buku & Literatur')],
            ['nama' => 'Furniture', 'slug' => Str::slug('Furniture')],
            ['nama' => 'Alat Pertukangan', 'slug' => Str::slug('Alat Pertukangan')],
            ['nama' => 'Kendaraan', 'slug' => Str::slug('Kendaraan')],
            ['nama' => 'Lain-lain', 'slug' => Str::slug('Lain-lain')],
        ];

        foreach ($kategoris as $kat) {
            Kategori::create($kat);
        }
    }
}