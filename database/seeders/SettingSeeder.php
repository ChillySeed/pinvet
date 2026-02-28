<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'surat_template',
                'value' => '<h1>Surat Peminjaman Barang</h1><p>Nomor: [nomor_surat]</p><p>Nama Peminjam: [nama_peminjam]</p><p>Instansi: [instansi]</p><p>Tanggal Pinjam: [tanggal_pinjam]</p><p>Tanggal Kembali: [tanggal_kembali]</p><p>Daftar Barang:</p><table border="1"><tr><th>No</th><th>Nama Barang</th><th>Jumlah</th></tr>[daftar_barang]</table><p>Biaya Sewa: [biaya_sewa]</p><p>Hormat kami,<br>[nama_penandatangan]<br>[jabatan_penandatangan]</p>',
                'type' => 'textarea',
            ],
            [
                'key' => 'surat_placeholder_list',
                'value' => json_encode([
                    '[nomor_surat]', '[nama_peminjam]', '[nim]', '[instansi]',
                    '[tanggal_pinjam]', '[tanggal_kembali]', '[daftar_barang]',
                    '[total_barang]', '[biaya_sewa]', '[nama_penandatangan]',
                    '[jabatan_penandatangan]'
                ]),
                'type' => 'json',
            ],
            [
                'key' => 'kop_surat',
                'value' => '',
                'type' => 'image',
            ],
            [
                'key' => 'logo',
                'value' => '',
                'type' => 'image',
            ],
            [
                'key' => 'ttd',
                'value' => '',
                'type' => 'image',
            ],
            [
                'key' => 'nama_ukm',
                'value' => 'UKM PINVET',
                'type' => 'text',
            ],
            [
                'key' => 'alamat_ukm',
                'value' => 'Jl. Kampus No. 1, Gedung Student Center Lt. 3',
                'type' => 'text',
            ],
            [
                'key' => 'nama_penandatangan',
                'value' => 'Ketua UKM',
                'type' => 'text',
            ],
            [
                'key' => 'jabatan_penandatangan',
                'value' => 'Ketua',
                'type' => 'text',
            ],
            [
                'key' => 'internal_nomor_format',
                'value' => '{nomor_urut:03d}.{kode_ukm}/R.{kode_divisi}/RIPTEK/{bulan_romawi}/{tahun}',
                'type' => 'text',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}