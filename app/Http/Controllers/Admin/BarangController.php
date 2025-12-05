<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::latest()->paginate(10);
        return view('admin.barang.index', compact('barang'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'pemilik_barang' => 'required|string|max:255',
            'deskripsi_barang' => 'nullable|string',
            'kategori_barang' => 'required|string|max:100',
            'jumlah_total' => 'required|integer|min:1',
            'kondisi_barang' => 'required|in:baik,rusak_ringan,rusak_berat',
            'lokasi_penyimpanan' => 'required|string|max:255',
            'gambar_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dapat_disewa' => 'boolean',
            'harga_sewa_per_hari' => 'required_if:dapat_disewa,1|numeric|min:0',
        ]);

        // Set jumlah tersedia sama dengan jumlah total saat pertama kali
        $validated['jumlah_tersedia'] = $validated['jumlah_total'];
        
        // Handle checkbox
        $validated['dapat_disewa'] = $request->has('dapat_disewa');

        // Handle image upload
        if ($request->hasFile('gambar_barang')) {
            $path = $request->file('gambar_barang')->store('barang', 'public');
            $validated['gambar_barang'] = $path;
        }

        Barang::create($validated);

        return redirect()->route('admin.barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Barang $barang)
    {
        return view('admin.barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'pemilik_barang' => 'required|string|max:255',
            'deskripsi_barang' => 'nullable|string',
            'kategori_barang' => 'required|string|max:100',
            'jumlah_total' => 'required|integer|min:1',
            'kondisi_barang' => 'required|in:baik,rusak_ringan,rusak_berat',
            'lokasi_penyimpanan' => 'required|string|max:255',
            'gambar_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dapat_disewa' => 'boolean',
            'harga_sewa_per_hari' => 'required_if:dapat_disewa,1|numeric|min:0',
        ]);

        // Update jumlah tersedia jika jumlah total berubah
        if ($validated['jumlah_total'] != $barang->jumlah_total) {
            $selisih = $validated['jumlah_total'] - $barang->jumlah_total;
            $validated['jumlah_tersedia'] = max(0, $barang->jumlah_tersedia + $selisih);
        }
        
        // Handle checkbox
        $validated['dapat_disewa'] = $request->has('dapat_disewa');

        // Handle image upload
        if ($request->hasFile('gambar_barang')) {
            // Delete old image if exists
            if ($barang->gambar_barang && Storage::disk('public')->exists($barang->gambar_barang)) {
                Storage::disk('public')->delete($barang->gambar_barang);
            }
            
            $path = $request->file('gambar_barang')->store('barang', 'public');
            $validated['gambar_barang'] = $path;
        }

        $barang->update($validated);

        return redirect()->route('admin.barang.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        // Delete image if exists
        if ($barang->gambar_barang && Storage::disk('public')->exists($barang->gambar_barang)) {
            Storage::disk('public')->delete($barang->gambar_barang);
        }

        $barang->delete();

        return redirect()->route('admin.barang.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}