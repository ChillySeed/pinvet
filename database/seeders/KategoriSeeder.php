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
            ['nama' => 'Alat Tulis Kantor', 'slug' => Str::slug('Alat Tulis Kantor')],
            ['nama' => 'Peralatan Olahraga', 'slug' => Str::slug('Peralatan Olahraga')],
            ['nama' => 'Perlengkapan Acara', 'slug' => Str::slug('Perlengkapan Acara')],
            ['nama' => 'Alat Musik', 'slug' => Str::slug('Alat Musik')],
            ['nama' => 'Komputer & Laptop', 'slug' => Str::slug('Komputer & Laptop')],
            ['nama' => 'Kamera & Fotografi', 'slug' => Str::slug('Kamera & Fotografi')],
            ['nama' => 'Robotika', 'slug' => Str::slug('Robotika')],
            ['nama' => 'Komponen Elektronik', 'slug' => Str::slug('Komponen Elektronik')],
            ['nama' => 'Jaringan & Komunikasi', 'slug' => Str::slug('Jaringan & Komunikasi')],
            ['nama' => 'Alat Laboratorium', 'slug' => Str::slug('Alat Laboratorium')],
            ['nama' => 'Sound System', 'slug' => Str::slug('Sound System')],
            ['nama' => 'Proyektor & Layar', 'slug' => Str::slug('Proyektor & Layar')],
            ['nama' => 'Drone', 'slug' => Str::slug('Drone')],
            ['nama' => 'Toolkit & Perkakas', 'slug' => Str::slug('Toolkit & Perkakas')],
            ['nama' => 'Buku & Referensi', 'slug' => Str::slug('Buku & Referensi')],
        ];

        foreach ($kategoris as $kat) {
            Kategori::firstOrCreate(
                ['slug' => $kat['slug']],
                $kat
            );
        }
    }
}