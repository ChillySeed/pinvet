<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::with('kategori')->paginate(10);
        return view('admin.barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.barang.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'pemilik_barang' => 'nullable|string|max:255',
            'deskripsi_barang' => 'nullable|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'jumlah_total' => 'required|integer|min:0',
            'jumlah_tersedia' => 'required|integer|min:0|lte:jumlah_total',
            'kondisi_barang' => 'required|string|max:50',
            'gambar_barang' => 'nullable|image|max:2048',
            'dapat_disewa' => 'sometimes|boolean',
            'harga_sewa_per_hari' => 'required_if:dapat_disewa,true|numeric|min:0',
        ]);

        if ($request->hasFile('gambar_barang')) {
            $path = $request->file('gambar_barang')->store('barang', 'public');
            $validated['gambar_barang'] = $path;
        }

        $validated['dapat_disewa'] = $request->boolean('dapat_disewa');

        Barang::create($validated);

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return view('admin.barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $kategoris = Kategori::all();
        return view('admin.barang.edit', compact('barang', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'pemilik_barang' => 'nullable|string|max:255',
            'deskripsi_barang' => 'nullable|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'jumlah_total' => 'required|integer|min:0',
            'jumlah_tersedia' => 'required|integer|min:0|lte:jumlah_total',
            'kondisi_barang' => 'required|string|max:50',
            'lokasi_penyimpanan' => 'required|string|max:255',
            'gambar_barang' => 'nullable|image|max:2048',
            'dapat_disewa' => 'sometimes|boolean',
            'harga_sewa_per_hari' => 'required_if:dapat_disewa,true|numeric|min:0',
        ]);

        if ($request->hasFile('gambar_barang')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar_barang) {
                Storage::disk('public')->delete($barang->gambar_barang);
            }
            $path = $request->file('gambar_barang')->store('barang', 'public');
            $validated['gambar_barang'] = $path;
        }

        $validated['dapat_disewa'] = $request->boolean('dapat_disewa');

        $barang->update($validated);

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        // Cek apakah barang sedang dipinjam (ada detail_peminjaman dengan status ongoing/disetujui)
        $sedangDipinjam = $barang->detailPeminjaman()
            ->whereHas('peminjaman', function ($q) {
                $q->whereIn('status_peminjaman', ['ongoing', 'disetujui']);
            })->exists();

        if ($sedangDipinjam) {
            return back()->with('error', 'Barang sedang dipinjam, tidak dapat dihapus.');
        }

        // Hapus gambar
        if ($barang->gambar_barang) {
            Storage::disk('public')->delete($barang->gambar_barang);
        }

        $barang->delete();

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}