<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::create([
            'key' => 'surat_template',
            'value' => '<h1>Surat Peminjaman Barang</h1><p>Nomor: [nomor_surat]</p><p>Nama Peminjam: [nama_peminjam]</p><p>Instansi: [instansi]</p><p>Tanggal Pinjam: [tanggal_pinjam]</p><p>Tanggal Kembali: [tanggal_kembali]</p><h3>Daftar Barang:</h3>[daftar_barang]<p>Total Barang: [total_barang]</p><p>Biaya Sewa: Rp [biaya_sewa]</p><p>Hormat kami,</p><p>[nama_penandatangan]<br>[jabatan_penandatangan]</p>',
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

        Setting::create([
            'key' => 'nama_ukm',
            'value' => 'UKM Teknologi Universitas',
            'type' => 'text',
        ]);

        Setting::create([
            'key' => 'alamat_ukm',
            'value' => 'Jl. Kampus No.1, Kota',
            'type' => 'text',
        ]);

        Setting::create([
            'key' => 'nama_penandatangan',
            'value' => 'Ketua UKM',
            'type' => 'text',
        ]);

        Setting::create([
            'key' => 'jabatan_penandatangan',
            'value' => 'Ketua',
            'type' => 'text',
        ]);

        Setting::create([
            'key' => 'internal_nomor_format',
            'value' => '{nomor_urut:03d}.{kode_ukm}/R.{kode_divisi}/RIPTEK/{bulan_romawi}/{tahun}',
            'type' => 'text',
        ]);

        Setting::create([
            'key' => 'kode_ukm',
            'value' => '05',
            'type' => 'text',
        ]);
    }
}