<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use App\Models\Kategori;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil id kategori berdasarkan nama
        $kategori = [
            'elektronik' => Kategori::where('slug', 'elektronik')->first()->id,
            'atk' => Kategori::where('slug', 'alat-tulis-kantor')->first()->id,
            'olahraga' => Kategori::where('slug', 'peralatan-olahraga')->first()->id,
            'acara' => Kategori::where('slug', 'perlengkapan-acara')->first()->id,
            'musik' => Kategori::where('slug', 'alat-musik')->first()->id,
            'komputer' => Kategori::where('slug', 'komputer-laptop')->first()->id,
            'kamera' => Kategori::where('slug', 'kamera-fotografi')->first()->id,
            'robotika' => Kategori::where('slug', 'robotika')->first()->id,
            'komponen' => Kategori::where('slug', 'komponen-elektronik')->first()->id,
            'jaringan' => Kategori::where('slug', 'jaringan-komunikasi')->first()->id,
            'lab' => Kategori::where('slug', 'alat-laboratorium')->first()->id,
            'sound' => Kategori::where('slug', 'sound-system')->first()->id,
            'proyektor' => Kategori::where('slug', 'proyektor-layar')->first()->id,
            'drone' => Kategori::where('slug', 'drone')->first()->id,
            'toolkit' => Kategori::where('slug', 'toolkit-perkakas')->first()->id,
            'buku' => Kategori::where('slug', 'buku-referensi')->first()->id,
        ];

        $barangs = [
            // Kamera & Fotografi
            [
                'nama_barang' => 'Kamera DSLR Canon EOS 1200D',
                'kategori_id' => $kategori['kamera'],
                'jumlah_total' => 3,
                'jumlah_tersedia' => 2,
                'deskripsi_barang' => 'Kamera DSLR dengan lensa kit 18-55mm, cocok untuk dokumentasi acara.',
                'gambar_barang' => 'images/barang/canon-eos-1200d.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 75000,
            ],
            [
                'nama_barang' => 'Kamera Mirrorless Sony A6400',
                'kategori_id' => $kategori['kamera'],
                'jumlah_total' => 2,
                'jumlah_tersedia' => 2,
                'deskripsi_barang' => 'Mirrorless dengan kemampuan video 4K, cocok untuk konten kreatif.',
                'gambar_barang' => 'images/barang/sony-a6400.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 100000,
            ],
            [
                'nama_barang' => 'Action Camera GoPro Hero 9',
                'kategori_id' => $kategori['kamera'],
                'jumlah_total' => 2,
                'jumlah_tersedia' => 1,
                'deskripsi_barang' => 'Waterproof, stabilisasi HyperSmooth, cocok untuk olahraga ekstrem.',
                'gambar_barang' => 'images/barang/gopro-hero9.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 50000,
            ],

            // Komputer & Laptop
            [
                'nama_barang' => 'Laptop Lenovo ThinkPad X1 Carbon',
                'kategori_id' => $kategori['komputer'],
                'jumlah_total' => 5,
                'jumlah_tersedia' => 4,
                'deskripsi_barang' => 'Laptop ringan dengan prosesor Intel i7, RAM 16GB, SSD 512GB.',
                'gambar_barang' => 'images/barang/thinkpad-x1.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 120000,
            ],
            [
                'nama_barang' => 'MacBook Pro 14" M1 Pro',
                'kategori_id' => $kategori['komputer'],
                'jumlah_total' => 2,
                'jumlah_tersedia' => 1,
                'deskripsi_barang' => 'Laptop Apple dengan chip M1 Pro, RAM 16GB, SSD 512GB.',
                'gambar_barang' => 'images/barang/macbook-pro.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 150000,
            ],
            [
                'nama_barang' => 'PC Desktop Gaming',
                'kategori_id' => $kategori['komputer'],
                'jumlah_total' => 2,
                'jumlah_tersedia' => 2,
                'deskripsi_barang' => 'PC dengan prosesor Ryzen 5, GPU GTX 1660, RAM 16GB.',
                'gambar_barang' => 'images/barang/pc-gaming.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 100000,
            ],

            // Robotika
            [
                'nama_barang' => 'Arduino Uno R3 Starter Kit',
                'kategori_id' => $kategori['robotika'],
                'jumlah_total' => 10,
                'jumlah_tersedia' => 8,
                'deskripsi_barang' => 'Paket lengkap Arduino Uno dengan sensor, LED, resistor, dan buku panduan.',
                'gambar_barang' => 'images/barang/arduino-uno.jpg',
                'dapat_disewa' => false,
                'harga_sewa_per_hari' => 0,
            ],
            [
                'nama_barang' => 'Raspberry Pi 4 Model B 4GB',
                'kategori_id' => $kategori['robotika'],
                'jumlah_total' => 5,
                'jumlah_tersedia' => 3,
                'deskripsi_barang' => 'Single-board computer dengan RAM 4GB, cocok untuk proyek IoT.',
                'gambar_barang' => 'images/barang/raspi4.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 25000,
            ],
            [
                'nama_barang' => 'Sensor Ultrasonik HC-SR04',
                'kategori_id' => $kategori['komponen'],
                'jumlah_total' => 20,
                'jumlah_tersedia' => 18,
                'deskripsi_barang' => 'Sensor jarak ultrasonik, jangkauan 2cm - 400cm.',
                'gambar_barang' => 'images/barang/hc-sr04.jpg',
                'dapat_disewa' => false,
                'harga_sewa_per_hari' => 0,
            ],
            [
                'nama_barang' => 'Motor DC dengan Gearbox',
                'kategori_id' => $kategori['komponen'],
                'jumlah_total' => 15,
                'jumlah_tersedia' => 12,
                'deskripsi_barang' => 'Motor DC 6V dengan gearbox, cocok untuk robot line follower.',
                'gambar_barang' => 'images/barang/motor-dc.jpg',
                'dapat_disewa' => false,
                'harga_sewa_per_hari' => 0,
            ],
            [
                'nama_barang' => 'Driver Motor L298N',
                'kategori_id' => $kategori['komponen'],
                'jumlah_total' => 10,
                'jumlah_tersedia' => 9,
                'deskripsi_barang' => 'Modul driver motor dual H-bridge, dapat mengendalikan 2 motor DC.',
                'gambar_barang' => 'images/barang/l298n.jpg',
                'dapat_disewa' => false,
                'harga_sewa_per_hari' => 0,
            ],

            // Alat Tulis Kantor
            [
                'nama_barang' => 'Whiteboard 90x120 cm',
                'kategori_id' => $kategori['atk'],
                'jumlah_total' => 4,
                'jumlah_tersedia' => 3,
                'deskripsi_barang' => 'Papan tulis putih dengan kaki lipat, cocok untuk presentasi.',
                'gambar_barang' => 'images/barang/whiteboard.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 15000,
            ],
            [
                'nama_barang' => 'Spidol Whiteboard (set isi 12)',
                'kategori_id' => $kategori['atk'],
                'jumlah_total' => 10,
                'jumlah_tersedia' => 10,
                'deskripsi_barang' => 'Set spidol whiteboard berbagai warna, tinta hitam, biru, merah, hijau.',
                'gambar_barang' => 'images/barang/spidol.jpg',
                'dapat_disewa' => false,
                'harga_sewa_per_hari' => 0,
            ],
            [
                'nama_barang' => 'Kertas HVS A4 80gr (1 rim)',
                'kategori_id' => $kategori['atk'],
                'jumlah_total' => 20,
                'jumlah_tersedia' => 15,
                'deskripsi_barang' => 'Kertas HVS A4 80gr, 1 rim = 500 lembar.',
                'gambar_barang' => 'images/barang/kertas-hvs.jpg',
                'dapat_disewa' => false,
                'harga_sewa_per_hari' => 0,
            ],

            // Peralatan Olahraga
            [
                'nama_barang' => 'Bola Basket Molten GG7X',
                'kategori_id' => $kategori['olahraga'],
                'jumlah_total' => 5,
                'jumlah_tersedia' => 4,
                'deskripsi_barang' => 'Bola basket ukuran 7, standar FIBA, kulit sintetis.',
                'gambar_barang' => 'images/barang/bola-basket.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 10000,
            ],
            [
                'nama_barang' => 'Raket Badminton Yonex Astrox',
                'kategori_id' => $kategori['olahraga'],
                'jumlah_total' => 6,
                'jumlah_tersedia' => 5,
                'deskripsi_barang' => 'Raket badminton ringan, sudah terpasang senar.',
                'gambar_barang' => 'images/barang/raket.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 15000,
            ],

            // Perlengkapan Acara
            [
                'nama_barang' => 'Sound System Portable 1000W',
                'kategori_id' => $kategori['sound'],
                'jumlah_total' => 2,
                'jumlah_tersedia' => 1,
                'deskripsi_barang' => 'Set sound system portable dengan 2 speaker aktif, mixer, dan mic wireless.',
                'gambar_barang' => 'images/barang/sound-system.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 200000,
            ],
            [
                'nama_barang' => 'Proyektor Epson EB-X41',
                'kategori_id' => $kategori['proyektor'],
                'jumlah_total' => 3,
                'jumlah_tersedia' => 2,
                'deskripsi_barang' => 'Proyektor 3600 lumens, resolusi XGA, cocok untuk presentasi.',
                'gambar_barang' => 'images/barang/proyektor.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 75000,
            ],
            [
                'nama_barang' => 'Layar Proyektor Tripod 70x70 inci',
                'kategori_id' => $kategori['proyektor'],
                'jumlah_total' => 3,
                'jumlah_tersedia' => 3,
                'deskripsi_barang' => 'Layar proyektor portable dengan tripod, ukuran 70x70 inci.',
                'gambar_barang' => 'images/barang/layar-proyektor.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 30000,
            ],

            // Alat Musik
            [
                'nama_barang' => 'Gitar Akustik Yamaha F310',
                'kategori_id' => $kategori['musik'],
                'jumlah_total' => 4,
                'jumlah_tersedia' => 3,
                'deskripsi_barang' => 'Gitar akustik ukuran standar, cocok untuk pemula.',
                'gambar_barang' => 'images/barang/gitar.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 25000,
            ],
            [
                'nama_barang' => 'Keyboard Digital Casio CT-S100',
                'kategori_id' => $kategori['musik'],
                'jumlah_total' => 2,
                'jumlah_tersedia' => 2,
                'deskripsi_barang' => 'Keyboard 61 tombol, portable, dengan berbagai suara.',
                'gambar_barang' => 'images/barang/keyboard.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 40000,
            ],

            // Jaringan & Komunikasi
            [
                'nama_barang' => 'Access Point TP-Link EAP225',
                'kategori_id' => $kategori['jaringan'],
                'jumlah_total' => 3,
                'jumlah_tersedia' => 2,
                'deskripsi_barang' => 'Access Point AC1200, support PoE, untuk kebutuhan jaringan.',
                'gambar_barang' => 'images/barang/ap-tplink.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 20000,
            ],
            [
                'nama_barang' => 'Kabel UTP CAT6 (roll 100m)',
                'kategori_id' => $kategori['jaringan'],
                'jumlah_total' => 2,
                'jumlah_tersedia' => 2,
                'deskripsi_barang' => 'Kabel jaringan UTP CAT6, panjang 100 meter.',
                'gambar_barang' => 'images/barang/kabel-utp.jpg',
                'dapat_disewa' => false,
                'harga_sewa_per_hari' => 0,
            ],

            // Drone
            [
                'nama_barang' => 'Drone DJI Mavic Air 2',
                'kategori_id' => $kategori['drone'],
                'jumlah_total' => 1,
                'jumlah_tersedia' => 1,
                'deskripsi_barang' => 'Drone dengan kamera 4K, 3-axis gimbal, jarak terbang 10km.',
                'gambar_barang' => 'images/barang/dji-mavic.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 150000,
            ],

            // Toolkit & Perkakas
            [
                'nama_barang' => 'Toolkit 46 in 1',
                'kategori_id' => $kategori['toolkit'],
                'jumlah_total' => 5,
                'jumlah_tersedia' => 4,
                'deskripsi_barang' => 'Toolkit lengkap dengan obeng, kunci, tang, dan lain-lain.',
                'gambar_barang' => 'images/barang/toolkit.jpg',
                'dapat_disewa' => true,
                'harga_sewa_per_hari' => 10000,
            ],

            // Buku
            [
                'nama_barang' => 'Buku Panduan Arduino untuk Pemula',
                'kategori_id' => $kategori['buku'],
                'jumlah_total' => 7,
                'jumlah_tersedia' => 5,
                'deskripsi_barang' => 'Buku referensi belajar Arduino, proyek sederhana.',
                'gambar_barang' => 'images/barang/buku-arduino.jpg',
                'dapat_disewa' => false,
                'harga_sewa_per_hari' => 0,
            ],
        ];

        foreach ($barangs as $barang) {
            Barang::firstOrCreate(
                ['nama_barang' => $barang['nama_barang']],
                $barang
            );
        }
    }
}