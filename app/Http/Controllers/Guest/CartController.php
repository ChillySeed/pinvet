<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Tampilkan isi keranjang
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $barangs = Barang::whereIn('id', array_keys($cart))->get();
        $total = 0;

        foreach ($barangs as $barang) {
            $barang->cart_quantity = $cart[$barang->id];
            $total += $barang->harga_sewa_per_hari * $barang->cart_quantity;
        }

        return view('guest.cart.index', compact('barangs', 'total'));
    }

    /**
     * Tambah barang ke keranjang
     */
    public function add(Request $request, Barang $barang)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1|max:' . $barang->jumlah_tersedia,
        ]);

        $cart = Session::get('cart', []);

        if (isset($cart[$barang->id])) {
            $cart[$barang->id] += $request->jumlah;
        } else {
            $cart[$barang->id] = $request->jumlah;
        }

        // Pastikan tidak melebihi stok
        if ($cart[$barang->id] > $barang->jumlah_tersedia) {
            $cart[$barang->id] = $barang->jumlah_tersedia;
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Barang ditambahkan ke keranjang.');
    }

    /**
     * Update jumlah barang di keranjang
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:0|max:' . $barang->jumlah_tersedia,
        ]);

        $cart = Session::get('cart', []);

        if ($request->jumlah == 0) {
            unset($cart[$barang->id]);
        } else {
            $cart[$barang->id] = $request->jumlah;
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Keranjang diperbarui.');
    }

    /**
     * Hapus barang dari keranjang
     */
    public function remove(Barang $barang)
    {
        $cart = Session::get('cart', []);
        unset($cart[$barang->id]);
        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Barang dihapus dari keranjang.');
    }

    /**
     * Mulai proses checkout (pilih tipe peminjam)
     */
    public function checkout()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        return view('guest.pilih-tipe');
    }
}