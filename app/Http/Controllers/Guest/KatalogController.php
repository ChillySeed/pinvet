<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::with('kategori')->where('jumlah_tersedia', '>', 0);

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        // Pencarian
        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        $barangs = $query->paginate(12);
        $kategoris = Kategori::all();

        return view('guest.katalog', compact('barangs', 'kategoris'));
    }

    public function show(Barang $barang)
    {
        return view('guest.barang-detail', compact('barang'));
    }
}