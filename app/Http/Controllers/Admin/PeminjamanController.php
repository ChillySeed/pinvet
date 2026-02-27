<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\RiwayatPeminjaman;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Peminjaman::with('details.barang');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status_peminjaman', $request->status);
        }

        // Pencarian
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_peminjam', 'like', '%' . $request->search . '%')
                  ->orWhere('nomor_surat_internal', 'like', '%' . $request->search . '%')
                  ->orWhere('nomor_surat_eksternal', 'like', '%' . $request->search . '%');
            });
        }

        $peminjamans = $query->latest()->paginate(10);

        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Biasanya admin tidak membuat peminjaman dari panel, tapi jika perlu bisa diisi
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load('details.barang', 'riwayat.user', 'inputBy');
        return view('admin.peminjaman.show', compact('peminjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        // Hanya bisa hapus jika status pending atau ditolak? Bisa diatur
        if (!in_array($peminjaman->status_peminjaman, ['pending', 'ditolak', 'dikembalikan'])) {
            return back()->with('error', 'Tidak dapat menghapus peminjaman dengan status aktif.');
        }

        // Hapus file surat jika ada
        if ($peminjaman->file_surat && file_exists(storage_path('app/public/' . $peminjaman->file_surat))) {
            unlink(storage_path('app/public/' . $peminjaman->file_surat));
        }

        $peminjaman->delete();

        return redirect()->route('admin.peminjaman.index')->with('success', 'Peminjaman berhasil dihapus.');
    }

    /**
     * Update status peminjaman (custom method)
     */
    public function updateStatus(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak,ongoing,dikembalikan,terlambat',
            'keterangan' => 'nullable|string',
        ]);

        $oldStatus = $peminjaman->status_peminjaman;
        $newStatus = $request->status;

        DB::transaction(function () use ($peminjaman, $oldStatus, $newStatus, $request) {
            // Update status
            $peminjaman->status_peminjaman = $newStatus;
            $peminjaman->save();

            // Catat riwayat
            RiwayatPeminjaman::create([
                'peminjaman_id' => $peminjaman->id,
                'user_id' => Auth::id(),
                'status_sebelumnya' => $oldStatus,
                'status_terbaru' => $newStatus,
                'keterangan' => $request->keterangan,
            ]);

            // Jika status menjadi ongoing, kurangi stok barang
            if ($newStatus == 'ongoing' && $oldStatus != 'ongoing') {
                foreach ($peminjaman->details as $detail) {
                    $barang = $detail->barang;
                    $barang->jumlah_tersedia -= $detail->jumlah_barang;
                    $barang->save();
                }
            }

            // Jika status menjadi dikembalikan, tambah stok
            if ($newStatus == 'dikembalikan' && $oldStatus != 'dikembalikan') {
                // Catat tanggal pengembalian aktual
                $peminjaman->tanggal_pengembalian_aktual = now();
                $peminjaman->save();

                foreach ($peminjaman->details as $detail) {
                    $barang = $detail->barang;
                    $barang->jumlah_tersedia += $detail->jumlah_barang;
                    $barang->save();
                }
            }

            // Jika status menjadi ditolak dari pending, tidak ada perubahan stok
        });

        return redirect()->route('admin.peminjaman.show', $peminjaman->id)
                         ->with('success', 'Status peminjaman berhasil diperbarui.');
    }
}