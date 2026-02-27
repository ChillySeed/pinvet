<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PeminjamanController extends Controller
{
    public function start($tipe)
    {
        if (!in_array($tipe, ['internal', 'eksternal'])) {
            abort(404);
        }

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        Session::put('peminjaman_tipe', $tipe);
        return redirect()->route('peminjaman.form', $tipe);
    }

    public function form($tipe)
    {
        if (!in_array($tipe, ['internal', 'eksternal'])) {
            abort(404);
        }

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        return view('guest.peminjaman.form-' . $tipe);
    }

    public function store(Request $request)
    {
        $tipe = Session::get('peminjaman_tipe');
        if (!$tipe || !in_array($tipe, ['internal', 'eksternal'])) {
            return redirect()->route('cart.index')->with('error', 'Sesi tidak valid.');
        }

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $rules = [
            'nama_peminjam' => 'required|string|max:255',
            'instansi_peminjam' => 'required|string|max:255',
            'kontak_peminjam' => 'required|string|max:20',
            'email_peminjam' => 'nullable|email',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'catatan' => 'nullable|string',
        ];

        if ($tipe == 'internal') {
            $rules['nim_peminjam'] = 'required|string|max:20';
            $rules['jabatan_peminjam'] = 'required|string|max:100';
        } else {
            $rules['nomor_surat_eksternal'] = 'nullable|string|max:100';
        }

        $validated = $request->validate($rules);

        $tglPinjam = \Carbon\Carbon::parse($validated['tanggal_pinjam']);
        $tglKembali = \Carbon\Carbon::parse($validated['tanggal_kembali']);
        $durasi = $tglPinjam->diffInDays($tglKembali) ?: 1;

        DB::beginTransaction();
        try {
            $peminjaman = Peminjaman::create([
                'tipe_peminjam' => $tipe,
                'user_id_input' => null,
                'nama_peminjam' => $validated['nama_peminjam'],
                'nim_peminjam' => $validated['nim_peminjam'] ?? null,
                'jabatan_peminjam' => $validated['jabatan_peminjam'] ?? null,
                'instansi_peminjam' => $validated['instansi_peminjam'],
                'kontak_peminjam' => $validated['kontak_peminjam'],
                'email_peminjam' => $validated['email_peminjam'] ?? null,
                'tanggal_pinjam' => $validated['tanggal_pinjam'],
                'tanggal_kembali' => $validated['tanggal_kembali'],
                'durasi_hari' => $durasi,
                'catatan' => $validated['catatan'] ?? null,
                'status_peminjaman' => 'pending',
                'nomor_surat_eksternal' => $validated['nomor_surat_eksternal'] ?? null,
                'biaya_sewa_total' => 0,
                'status_pembayaran' => 'belum_lunas',
            ]);

            $totalBiaya = 0;
            foreach ($cart as $barangId => $jumlah) {
                $barang = Barang::findOrFail($barangId);
                $subtotal = $barang->harga_sewa_per_hari * $jumlah * $durasi;
                $totalBiaya += $subtotal;

                DetailPeminjaman::create([
                    'peminjaman_id' => $peminjaman->id,
                    'barang_id' => $barang->id,
                    'jumlah_barang' => $jumlah,
                    'harga_sewa_per_unit' => $barang->harga_sewa_per_hari,
                    'subtotal_sewa' => $subtotal,
                ]);
            }

            $peminjaman->update(['biaya_sewa_total' => $totalBiaya]);

            Session::forget('cart');
            Session::forget('peminjaman_tipe');
            Session::put('last_peminjaman_id', $peminjaman->id);

            DB::commit();

            return redirect()->route('peminjaman.preview', $peminjaman->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}