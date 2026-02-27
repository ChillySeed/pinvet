<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Peminjaman;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pembayaran::with('peminjaman');

        if ($request->filled('status')) {
            $query->where('status_verifikasi', $request->status);
        }

        $pembayarans = $query->latest()->paginate(10);
        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mungkin bisa dibuat, tapi sederhana saja
        $peminjamans = Peminjaman::where('status_pembayaran', '!=', 'lunas')->get();
        return view('admin.pembayaran.create', compact('peminjamans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'jumlah_bayar' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|string',
            'tanggal_bayar' => 'required|date',
            'bukti_pembayaran' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            $validated['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('pembayaran', 'public');
        }

        $validated['status_verifikasi'] = 'pending';

        Pembayaran::create($validated);

        return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil dicatat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        // Bisa untuk verifikasi
        return view('admin.pembayaran.edit', compact('pembayaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $validated = $request->validate([
            'status_verifikasi' => 'required|in:pending,verified,rejected',
            'catatan' => 'nullable|string',
        ]);

        $pembayaran->update($validated);

        // Jika verifikasi disetujui, ubah status pembayaran peminjaman
        if ($validated['status_verifikasi'] == 'verified') {
            $peminjaman = $pembayaran->peminjaman;
            $totalDibayar = $peminjaman->pembayaran()->where('status_verifikasi', 'verified')->sum('jumlah_bayar');
            if ($totalDibayar >= $peminjaman->biaya_sewa_total) {
                $peminjaman->status_pembayaran = 'lunas';
            } else {
                $peminjaman->status_pembayaran = 'belum_lunas';
            }
            $peminjaman->save();
        }

        return redirect()->route('admin.pembayaran.show', $pembayaran->id)
                         ->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        if ($pembayaran->bukti_pembayaran && Storage::disk('public')->exists($pembayaran->bukti_pembayaran)) {
            Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
        }

        $pembayaran->delete();

        return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}