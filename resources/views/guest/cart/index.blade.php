@extends('layouts.guest')

@section('title', 'Keranjang Peminjaman - PINVET')

@section('content')
<div class="container py-5 mt-5">
    <h1 class="mb-4">Keranjang Peminjaman</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($barangs) || $barangs->isEmpty())
        <div class="alert alert-info">
            Keranjang Anda kosong. <a href="{{ route('guest.katalog.index') }}">Lihat katalog</a> untuk mulai meminjam.
        </div>
    @else
        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>Harga Sewa/Hari</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barangs as $barang)
                            <tr>
                                <td>
                                    <img src="{{ $barang->gambar_barang ? asset('storage/'.$barang->gambar_barang) : 'https://via.placeholder.com/50' }}" 
                                         width="50" class="me-2" alt="">
                                    {{ $barang->nama_barang }}
                                </td>
                                <td>Rp {{ number_format($barang->harga_sewa_per_hari, 0, ',', '.') }}</td>
                                <td>
                                    <input type="number" name="jumlah[{{ $barang->id }}]" 
                                           value="{{ $barang->cart_quantity }}" 
                                           min="1" max="{{ $barang->jumlah_tersedia }}" 
                                           class="form-control" style="width: 80px;">
                                </td>
                                <td>Rp {{ number_format($barang->harga_sewa_per_hari * $barang->cart_quantity, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $barang) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus barang dari keranjang?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total Biaya Sewa (per hari):</th>
                            <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('guest.katalog.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Lanjutkan Belanja
                </a>
                <button type="submit" class="btn btn-primary">
                    Lanjutkan Peminjaman <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </form>
    @endif
</div>
@endsection