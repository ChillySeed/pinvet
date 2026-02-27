@extends('layouts.guest')

@section('title', 'Katalog Barang - PINVET')

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Katalog Barang</h1>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar Filter -->
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Filter</h5>
                    <form action="{{ route('guest.katalog.index') }}" method="GET">
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" class="form-select">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->slug }}" {{ request('kategori') == $kategori->slug ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cari</label>
                            <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Nama barang...">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Terapkan Filter</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Daftar Barang -->
        <div class="col-md-9">
            <div class="row g-4">
                @forelse($barangs as $barang)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ $barang->gambar_barang ? asset('storage/'.$barang->gambar_barang) : 'https://via.placeholder.com/300' }}" 
                                 class="card-img-top" alt="{{ $barang->nama_barang }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                                <p class="card-text text-muted">{{ $barang->kategori->nama }}</p>
                                <p class="card-text">Stok: {{ $barang->jumlah_tersedia }}</p>
                                @if($barang->dapat_disewa)
                                    <p class="card-text text-success">Rp {{ number_format($barang->harga_sewa_per_hari, 0, ',', '.') }}/hari</p>
                                @endif
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('guest.katalog.show', $barang) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <form action="{{ route('cart.add', $barang) }}" method="POST" class="d-inline add-to-cart-form">
                                        @csrf
                                        <input type="hidden" name="jumlah" value="1">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-cart-plus"></i> Tambah
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">Tidak ada barang ditemukan.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $barangs->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Notifikasi untuk tambah keranjang (tidak redirect) -->
@push('scripts')
<script>
    $(document).ready(function() {
        $('.add-to-cart-form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            
            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(),
                success: function(response) {
                    // Update cart count
                    $('#cart-count').text(response.cart_count);
                    
                    // Tampilkan notifikasi (bisa pakai toast)
                    alert('Barang ditambahkan ke keranjang!');
                },
                error: function(xhr) {
                    alert('Gagal menambahkan barang: ' + xhr.responseJSON.message);
                }
            });
        });
    });
</script>
@endpush
@endsection