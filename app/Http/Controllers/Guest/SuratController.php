<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Setting;
use App\Models\DetailPeminjaman;
use App\Models\RiwayatPeminjaman;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratController extends Controller
{
    /**
     * Tampilkan preview surat sebelum generate
     */
    public function preview(Peminjaman $peminjaman)
    {
        // Pastikan peminjaman milik session? Untuk guest, kita perlu verifikasi
        // Sederhana: asumsikan peminjaman baru dibuat dan bisa diakses via session atau parameter
        // Bisa menggunakan token atau session id.
        // Di sini kita asumsikan sudah ada mekanisme keamanan sederhana (misal session contains id)
        if (session('last_peminjaman_id') != $peminjaman->id) {
            abort(403);
        }

        $peminjaman->load('details.barang');
        return view('guest.preview-surat', compact('peminjaman'));
    }

    /**
     * Generate PDF surat
     */
    public function generate(Request $request, Peminjaman $peminjaman)
    {
        // Verifikasi lagi
        if (session('last_peminjaman_id') != $peminjaman->id) {
            abort(403);
        }

        // Validasi input untuk kustomisasi surat (jika diizinkan)
        $request->validate([
            'nomor_surat_eksternal' => 'nullable|string|max:100',
            'nama_penandatangan' => 'nullable|string|max:255',
            'jabatan_penandatangan' => 'nullable|string|max:255',
        ]);

        // Update nomor surat eksternal jika diisi
        if ($request->filled('nomor_surat_eksternal')) {
            $peminjaman->nomor_surat_eksternal = $request->nomor_surat_eksternal;
        }

        // Generate nomor internal jika belum ada
        if (!$peminjaman->nomor_surat_internal) {
            $peminjaman->nomor_surat_internal = $this->generateNomorSuratInternal($peminjaman);
        }

        $peminjaman->save();

        // Ambil template surat dari settings
        $template = Setting::where('key', 'surat_template')->value('value') ?? '';

        // Data untuk surat
        $data = [
            'peminjaman' => $peminjaman,
            'nomor_surat' => $peminjaman->nomor_surat, // accessor
            'nama_peminjam' => $peminjaman->nama_peminjam,
            'nim' => $peminjaman->nim_peminjam,
            'instansi' => $peminjaman->instansi_peminjam,
            'tanggal_pinjam' => $peminjaman->tanggal_pinjam->format('d-m-Y'),
            'tanggal_kembali' => $peminjaman->tanggal_kembali->format('d-m-Y'),
            'daftar_barang' => $peminjaman->details,
            'total_barang' => $peminjaman->details->sum('jumlah_barang'),
            'biaya_sewa' => number_format($peminjaman->biaya_sewa_total, 2),
            'nama_penandatangan' => $request->nama_penandatangan ?? Setting::where('key', 'nama_penandatangan')->value('value') ?? 'Ketua UKM',
            'jabatan_penandatangan' => $request->jabatan_penandatangan ?? Setting::where('key', 'jabatan_penandatangan')->value('value') ?? 'Ketua',
        ];

        // Render PDF
        $pdf = Pdf::loadView('surat.template', $data);

        // Simpan file PDF
        $filename = 'surat_' . $peminjaman->id . '_' . time() . '.pdf';
        $path = 'surat/' . $filename;
        Storage::disk('public')->put($path, $pdf->output());

        // Update path file di peminjaman
        $peminjaman->file_surat = $path;
        $peminjaman->save();

        // Hapus session last_peminjaman_id
        session()->forget('last_peminjaman_id');

        // Download PDF
        return $pdf->download($filename);
    }

    /**
     * Helper untuk generate nomor surat internal
     */
    private function generateNomorSuratInternal(Peminjaman $peminjaman)
    {
        // Format contoh: 002.05/R.09/RIPTEK/II/2026
        // Kita bisa ambil dari settings
        $format = Setting::where('key', 'internal_nomor_format')->value('value') ?? '{nomor_urut:03d}.{kode_ukm}/R.{kode_divisi}/RIPTEK/{bulan_romawi}/{tahun}';

        // Hitung nomor urut berdasarkan tahun
        $tahun = $peminjaman->created_at->format('Y');
        $bulan = $peminjaman->created_at->format('m');
        $count = Peminjaman::whereYear('created_at', $tahun)
                 ->whereNotNull('nomor_surat_internal')
                 ->count() + 1;

        // Data pengganti
        $replace = [
            '{nomor_urut}' => str_pad($count, 3, '0', STR_PAD_LEFT),
            '{kode_ukm}' => '05', // contoh, bisa dari setting
            '{kode_divisi}' => '09',
            '{bulan_romawi}' => $this->numberToRoman($bulan),
            '{tahun}' => $tahun,
        ];

        return str_replace(array_keys($replace), array_values($replace), $format);
    }

    private function numberToRoman($number)
    {
        $map = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V',
            6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X',
            11 => 'XI', 12 => 'XII'
        ];
        return $map[$number] ?? $number;
    }
}