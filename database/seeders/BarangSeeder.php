<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use App\Models\Kategori;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID kategori berdasarkan slug
        $kategori = [];
        $kategori['elektronik'] = Kategori::where('slug', 'elektronik')->first()->id;
        $kategori['komputer'] = Kategori::where('slug', 'komputer-laptop')->first()->id;
        $kategori['kamera'] = Kategori::where('slug', 'kamera-videografi')->first()->id;
        $kategori['audio'] = Kategori::where('slug', 'audio-sound-system')->first()->id;
        $kategori['atk'] = Kategori::where('slug', 'alat-tulis-kantor-atk')->first()->id;
        $kategori['acara'] = Kategori::where('slug', 'perlengkapan-acara')->first()->id;
        $kategori['olahraga'] = Kategori::where('slug', 'peralatan-olahraga')->first()->id;
        $kategori['robotika'] = Kategori::where('slug', 'komponen-robotika')->first()->id;
        $kategori['praktikum'] = Kategori::where('slug', 'alat-praktikum')->first()->id;
        $kategori['buku'] = Kategori::where('slug', 'buku-literatur')->first()->id;
        $kategori['furniture'] = Kategori::where('slug', 'furniture')->first()->id;
        $kategori['pertukangan'] = Kategori::where('slug', 'alat-pertukangan')->first()->id;
        $kategori['kendaraan'] = Kategori::where('slug', 'kendaraan')->first()->id;

        $items = [
            // Elektronik
            ['nama' => 'Televisi LED 32 inch', 'kategori' => $kategori['elektronik'], 'total' => 2, 'tersedia' => 2, 'kondisi' => 'baik', 'lokasi' => 'Ruang TV', 'dapat_disewa' => true, 'harga_sewa' => 50000],
            ['nama' => 'Proyektor Epson EB-X05', 'kategori' => $kategori['elektronik'], 'total' => 3, 'tersedia' => 2, 'kondisi' => 'baik', 'lokasi' => 'Ruang Media', 'dapat_disewa' => true, 'harga_sewa' => 75000],
            ['nama' => 'Speaker aktif 15 inch', 'kategori' => $kategori['audio'], 'total' => 4, 'tersedia' => 4, 'kondisi' => 'baik', 'lokasi' => 'Gudang Sound', 'dapat_disewa' => true, 'harga_sewa' => 100000],
            ['nama' => 'Mixer Yamaha 8 channel', 'kategori' => $kategori['audio'], 'total' => 1, 'tersedia' => 1, 'kondisi' => 'baik', 'lokasi' => 'Ruang Audio', 'dapat_disewa' => true, 'harga_sewa' => 150000],
            ['nama' => 'Microphone wireless Sennheiser', 'kategori' => $kategori['audio'], 'total' => 5, 'tersedia' => 4, 'kondisi' => 'baik', 'lokasi' => 'Ruang Audio', 'dapat_disewa' => true, 'harga_sewa' => 50000],
            ['nama' => 'Kabel roll 10 meter', 'kategori' => $kategori['elektronik'], 'total' => 10, 'tersedia' => 8, 'kondisi' => 'baik', 'lokasi' => 'Gudang', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Adaptor universal', 'kategori' => $kategori['elektronik'], 'total' => 6, 'tersedia' => 6, 'kondisi' => 'baik', 'lokasi' => 'Ruang Elektro', 'dapat_disewa' => false, 'harga_sewa' => 0],

            // Komputer
            ['nama' => 'Laptop ASUS ROG', 'kategori' => $kategori['komputer'], 'total' => 2, 'tersedia' => 1, 'kondisi' => 'baik', 'lokasi' => 'Lab Komputer', 'dapat_disewa' => true, 'harga_sewa' => 150000],
            ['nama' => 'PC Desktop Intel i7', 'kategori' => $kategori['komputer'], 'total' => 3, 'tersedia' => 3, 'kondisi' => 'baik', 'lokasi' => 'Lab Komputer', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Monitor 24 inch', 'kategori' => $kategori['komputer'], 'total' => 5, 'tersedia' => 4, 'kondisi' => 'baik', 'lokasi' => 'Lab', 'dapat_disewa' => true, 'harga_sewa' => 30000],
            ['nama' => 'Keyboard mechanical', 'kategori' => $kategori['komputer'], 'total' => 10, 'tersedia' => 9, 'kondisi' => 'baik', 'lokasi' => 'Lab', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Mouse wireless', 'kategori' => $kategori['komputer'], 'total' => 15, 'tersedia' => 12, 'kondisi' => 'baik', 'lokasi' => 'Lab', 'dapat_disewa' => false, 'harga_sewa' => 0],

            // Kamera
            ['nama' => 'Kamera DSLR Canon EOS 1500D', 'kategori' => $kategori['kamera'], 'total' => 2, 'tersedia' => 2, 'kondisi' => 'baik', 'lokasi' => 'Ruang Media', 'dapat_disewa' => true, 'harga_sewa' => 100000],
            ['nama' => 'Kamera Mirrorless Sony A6000', 'kategori' => $kategori['kamera'], 'total' => 1, 'tersedia' => 1, 'kondisi' => 'baik', 'lokasi' => 'Ruang Media', 'dapat_disewa' => true, 'harga_sewa' => 125000],
            ['nama' => 'Lensa 18-55mm', 'kategori' => $kategori['kamera'], 'total' => 3, 'tersedia' => 3, 'kondisi' => 'baik', 'lokasi' => 'Ruang Media', 'dapat_disewa' => true, 'harga_sewa' => 25000],
            ['nama' => 'Tripod', 'kategori' => $kategori['kamera'], 'total' => 4, 'tersedia' => 3, 'kondisi' => 'baik', 'lokasi' => 'Gudang', 'dapat_disewa' => true, 'harga_sewa' => 15000],
            ['nama' => 'Lighting set', 'kategori' => $kategori['kamera'], 'total' => 2, 'tersedia' => 2, 'kondisi' => 'baik', 'lokasi' => 'Studio', 'dapat_disewa' => true, 'harga_sewa' => 40000],

            // ATK
            ['nama' => 'Kertas HVS A4 80gr', 'kategori' => $kategori['atk'], 'total' => 50, 'tersedia' => 45, 'kondisi' => 'baik', 'lokasi' => 'Gudang ATK', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Pulpen standard', 'kategori' => $kategori['atk'], 'total' => 100, 'tersedia' => 80, 'kondisi' => 'baik', 'lokasi' => 'Gudang ATK', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Spidol whiteboard', 'kategori' => $kategori['atk'], 'total' => 30, 'tersedia' => 25, 'kondisi' => 'baik', 'lokasi' => 'Gudang', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Stapler besar', 'kategori' => $kategori['atk'], 'total' => 5, 'tersedia' => 4, 'kondisi' => 'baik', 'lokasi' => 'Ruang Sekre', 'dapat_disewa' => false, 'harga_sewa' => 0],

            // Perlengkapan Acara
            ['nama' => 'Tenda lipat 3x3', 'kategori' => $kategori['acara'], 'total' => 2, 'tersedia' => 2, 'kondisi' => 'baik', 'lokasi' => 'Gudang', 'dapat_disewa' => true, 'harga_sewa' => 50000],
            ['nama' => 'Meja lipat', 'kategori' => $kategori['acara'], 'total' => 10, 'tersedia' => 8, 'kondisi' => 'baik', 'lokasi' => 'Gudang', 'dapat_disewa' => true, 'harga_sewa' => 10000],
            ['nama' => 'Kursi lipat', 'kategori' => $kategori['acara'], 'total' => 50, 'tersedia' => 45, 'kondisi' => 'baik', 'lokasi' => 'Gudang', 'dapat_disewa' => true, 'harga_sewa' => 5000],
            ['nama' => 'Sound system portable', 'kategori' => $kategori['acara'], 'total' => 2, 'tersedia' => 2, 'kondisi' => 'baik', 'lokasi' => 'Ruang Sound', 'dapat_disewa' => true, 'harga_sewa' => 75000],

            // Olahraga
            ['nama' => 'Bola basket', 'kategori' => $kategori['olahraga'], 'total' => 5, 'tersedia' => 4, 'kondisi' => 'baik', 'lokasi' => 'Gudang OR', 'dapat_disewa' => true, 'harga_sewa' => 5000],
            ['nama' => 'Bola voli', 'kategori' => $kategori['olahraga'], 'total' => 5, 'tersedia' => 5, 'kondisi' => 'baik', 'lokasi' => 'Gudang OR', 'dapat_disewa' => true, 'harga_sewa' => 5000],
            ['nama' => 'Raket badminton', 'kategori' => $kategori['olahraga'], 'total' => 10, 'tersedia' => 8, 'kondisi' => 'baik', 'lokasi' => 'Gudang OR', 'dapat_disewa' => true, 'harga_sewa' => 3000],
            ['nama' => 'Shuttlecock', 'kategori' => $kategori['olahraga'], 'total' => 20, 'tersedia' => 15, 'kondisi' => 'baik', 'lokasi' => 'Gudang OR', 'dapat_disewa' => false, 'harga_sewa' => 0],

            // Robotika (komponen)
            ['nama' => 'Arduino Uno R3', 'kategori' => $kategori['robotika'], 'total' => 10, 'tersedia' => 8, 'kondisi' => 'baik', 'lokasi' => 'Lab Robotika', 'dapat_disewa' => true, 'harga_sewa' => 10000],
            ['nama' => 'Sensor Ultrasonik HC-SR04', 'kategori' => $kategori['robotika'], 'total' => 20, 'tersedia' => 18, 'kondisi' => 'baik', 'lokasi' => 'Lab Robotika', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Motor DC 12V', 'kategori' => $kategori['robotika'], 'total' => 15, 'tersedia' => 12, 'kondisi' => 'baik', 'lokasi' => 'Lab Robotika', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Driver motor L298N', 'kategori' => $kategori['robotika'], 'total' => 10, 'tersedia' => 9, 'kondisi' => 'baik', 'lokasi' => 'Lab Robotika', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Baterai LiPo 11.1V', 'kategori' => $kategori['robotika'], 'total' => 8, 'tersedia' => 6, 'kondisi' => 'baik', 'lokasi' => 'Lab Robotika', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Raspberry Pi 4', 'kategori' => $kategori['robotika'], 'total' => 3, 'tersedia' => 2, 'kondisi' => 'baik', 'lokasi' => 'Lab Robotika', 'dapat_disewa' => true, 'harga_sewa' => 20000],
            ['nama' => 'ESC 30A', 'kategori' => $kategori['robotika'], 'total' => 12, 'tersedia' => 10, 'kondisi' => 'baik', 'lokasi' => 'Lab Robotika', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Motor brushless 2200kV', 'kategori' => $kategori['robotika'], 'total' => 8, 'tersedia' => 7, 'kondisi' => 'baik', 'lokasi' => 'Lab Robotika', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Propeller 10x4.5', 'kategori' => $kategori['robotika'], 'total' => 20, 'tersedia' => 15, 'kondisi' => 'baik', 'lokasi' => 'Lab Robotika', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Frame quadcopter 450', 'kategori' => $kategori['robotika'], 'total' => 2, 'tersedia' => 2, 'kondisi' => 'baik', 'lokasi' => 'Lab Robotika', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'GPS module', 'kategori' => $kategori['robotika'], 'total' => 5, 'tersedia' => 4, 'kondisi' => 'baik', 'lokasi' => 'Lab Robotika', 'dapat_disewa' => false, 'harga_sewa' => 0],

            // Alat Praktikum
            ['nama' => 'Multimeter digital', 'kategori' => $kategori['praktikum'], 'total' => 8, 'tersedia' => 7, 'kondisi' => 'baik', 'lokasi' => 'Lab', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Osiloskop', 'kategori' => $kategori['praktikum'], 'total' => 2, 'tersedia' => 2, 'kondisi' => 'baik', 'lokasi' => 'Lab', 'dapat_disewa' => true, 'harga_sewa' => 30000],
            ['nama' => 'Function generator', 'kategori' => $kategori['praktikum'], 'total' => 3, 'tersedia' => 3, 'kondisi' => 'baik', 'lokasi' => 'Lab', 'dapat_disewa' => true, 'harga_sewa' => 20000],
            ['nama' => 'Power supply', 'kategori' => $kategori['praktikum'], 'total' => 5, 'tersedia' => 4, 'kondisi' => 'baik', 'lokasi' => 'Lab', 'dapat_disewa' => false, 'harga_sewa' => 0],

            // Buku
            ['nama' => 'Pemrograman Arduino', 'kategori' => $kategori['buku'], 'total' => 5, 'tersedia' => 5, 'kondisi' => 'baik', 'lokasi' => 'Perpustakaan', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Belajar Elektronika', 'kategori' => $kategori['buku'], 'total' => 3, 'tersedia' => 2, 'kondisi' => 'baik', 'lokasi' => 'Perpustakaan', 'dapat_disewa' => false, 'harga_sewa' => 0],

            // Furniture
            ['nama' => 'Meja rapat', 'kategori' => $kategori['furniture'], 'total' => 2, 'tersedia' => 2, 'kondisi' => 'baik', 'lokasi' => 'Ruang Rapat', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Kursi kantor', 'kategori' => $kategori['furniture'], 'total' => 20, 'tersedia' => 18, 'kondisi' => 'baik', 'lokasi' => 'Ruang Sekre', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Lemari besi', 'kategori' => $kategori['furniture'], 'total' => 3, 'tersedia' => 3, 'kondisi' => 'baik', 'lokasi' => 'Gudang', 'dapat_disewa' => false, 'harga_sewa' => 0],

            // Alat pertukangan
            ['nama' => 'Bor listrik', 'kategori' => $kategori['pertukangan'], 'total' => 2, 'tersedia' => 2, 'kondisi' => 'baik', 'lokasi' => 'Gudang', 'dapat_disewa' => true, 'harga_sewa' => 15000],
            ['nama' => 'Gergaji', 'kategori' => $kategori['pertukangan'], 'total' => 3, 'tersedia' => 3, 'kondisi' => 'baik', 'lokasi' => 'Gudang', 'dapat_disewa' => false, 'harga_sewa' => 0],
            ['nama' => 'Obeng set', 'kategori' => $kategori['pertukangan'], 'total' => 5, 'tersedia' => 4, 'kondisi' => 'baik', 'lokasi' => 'Gudang', 'dapat_disewa' => false, 'harga_sewa' => 0],

            // Kendaraan
            ['nama' => 'Mobil operasional', 'kategori' => $kategori['kendaraan'], 'total' => 1, 'tersedia' => 1, 'kondisi' => 'baik', 'lokasi' => 'Parkir', 'dapat_disewa' => true, 'harga_sewa' => 200000],
            ['nama' => 'Sepeda motor', 'kategori' => $kategori['kendaraan'], 'total' => 2, 'tersedia' => 2, 'kondisi' => 'baik', 'lokasi' => 'Parkir', 'dapat_disewa' => true, 'harga_sewa' => 50000],
        ];

        foreach ($items as $item) {
            Barang::create([
                'nama_barang' => $item['nama'],
                'pemilik_barang' => 'UKM',
                'deskripsi_barang' => 'Deskripsi ' . $item['nama'],
                'kategori_id' => $item['kategori'],
                'jumlah_total' => $item['total'],
                'jumlah_tersedia' => $item['tersedia'],
                'kondisi_barang' => $item['kondisi'],
                'lokasi_penyimpanan' => $item['lokasi'],
                'gambar_barang' => null,
                'dapat_disewa' => $item['dapat_disewa'],
                'harga_sewa_per_hari' => $item['harga_sewa'],
            ]);
        }
    }
}