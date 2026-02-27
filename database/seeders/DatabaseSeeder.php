<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat admin pertama
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Buat beberapa kategori contoh
        $kategoris = [
            ['nama' => 'Elektronik', 'slug' => 'elektronik'],
            ['nama' => 'Alat Tulis', 'slug' => 'alat-tulis'],
            ['nama' => 'Peralatan Olahraga', 'slug' => 'peralatan-olahraga'],
            ['nama' => 'Perlengkapan Acara', 'slug' => 'perlengkapan-acara'],
        ];
        foreach ($kategoris as $kat) {
            Kategori::create($kat);
        }

        // Buat setting default untuk template surat (sementara)
        Setting::create([
            'key' => 'surat_template',
            'value' => '<h1>Surat Peminjaman Barang</h1><p>Nomor: [nomor_surat]</p><p>Nama Peminjam: [nama_peminjam]</p>...',
            'type' => 'textarea',
        ]);

        Setting::create([
            'key' => 'surat_placeholder_list',
            'value' => json_encode([
                '[nomor_surat]', '[nama_peminjam]', '[nim]', '[instansi]',
                '[tanggal_pinjam]', '[tanggal_kembali]', '[daftar_barang]',
                '[total_barang]', '[biaya_sewa]', '[nama_penandatangan]',
                '[jabatan_penandatangan]'
            ]),
            'type' => 'json',
        ]);

        Setting::create([
            'key' => 'kop_surat',
            'value' => '',
            'type' => 'image',
        ]);

        Setting::create([
            'key' => 'logo',
            'value' => '',
            'type' => 'image',
        ]);

        Setting::create([
            'key' => 'ttd',
            'value' => '',
            'type' => 'image',
        ]);

        // Pengaturan umum
        Setting::create([
            'key' => 'nama_ukm',
            'value' => 'UKM Contoh',
            'type' => 'text',
        ]);
        Setting::create([
            'key' => 'alamat_ukm',
            'value' => 'Jl. Kampus No.1',
            'type' => 'text',
        ]);
    }
}