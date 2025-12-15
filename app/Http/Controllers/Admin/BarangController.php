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
        $barangs = Barang::latest()->paginate(10);
        return view('admin.barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'pemilik_barang' => 'required|string|max:255',
            'kategori_barang' => 'required|string|max:100',
            'jumlah_total' => 'required|integer|min:1',
            'jumlah_tersedia' => 'required|integer|min:0',
            'kondisi_barang' => 'required|in:baik,rusak_ringan,rusak_berat',
            'lokasi_penyimpanan' => 'required|string|max:255',
            'gambar_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga_sewa_per_hari' => 'required_if:dapat_disewa,1|numeric|min:0',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_barang')) {
            $imageName = time().'.'.$request->gambar_barang->extension();
            $request->gambar_barang->move(public_path('images/barang'), $imageName);
            $data['gambar_barang'] = $imageName;
        }

        Barang::create($data);

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
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'pemilik_barang' => 'required|string|max:255',
            'kategori_barang' => 'required|string|max:100',
            'jumlah_total' => 'required|integer|min:1',
            'jumlah_tersedia' => 'required|integer|min:0',
            'kondisi_barang' => 'required|in:baik,rusak_ringan,rusak_berat',
            'lokasi_penyimpanan' => 'required|string|max:255',
            'gambar_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga_sewa_per_hari' => 'required_if:dapat_disewa,1|numeric|min:0',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_barang')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar_barang && file_exists(public_path('images/barang/'.$barang->gambar_barang))) {
                unlink(public_path('images/barang/'.$barang->gambar_barang));
            }

            $imageName = time().'.'.$request->gambar_barang->extension();
            $request->gambar_barang->move(public_path('images/barang'), $imageName);
            $data['gambar_barang'] = $imageName;
        }

        $barang->update($data);

        return redirect()->route('admin.barang.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        // Hapus gambar jika ada
        if ($barang->gambar_barang && file_exists(public_path('images/barang/'.$barang->gambar_barang))) {
            unlink(public_path('images/barang/'.$barang->gambar_barang));
        }

        $barang->delete();

        return redirect()->route('admin.barang.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}