@extends('layouts.guest')

@section('title', $barang->nama_barang . ' - PINVET')

@section('content')
<div class="container py-5 mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('guest.katalog.index') }}">Katalog</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $barang->nama_barang }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-6">
            <img src="{{ $barang->gambar_barang ? asset('storage/'.$barang->gambar_barang) : 'https://via.placeholder.com/600' }}" 
                 class="img-fluid rounded shadow" alt="{{ $barang->nama_barang }}">
        </div>
        <div class="col-md-6">
            <h1>{{ $barang->nama_barang }}</h1>
            <p class="text-muted">Kategori: {{ $barang->kategori->nama }}</p>
            
            <div class="mb-3">
                <span class="badge bg-{{ $barang->kondisi_barang == 'baik' ? 'success' : 'warning' }}">
                    {{ $barang->kondisi_barang }}
                </span>
                <span class="badge bg-info">Stok: {{ $barang->jumlah_tersedia }}</span>
            </div>

            <p class="lead">{{ $barang->deskripsi_barang }}</p>

            @if($barang->dapat_disewa)
                <h4 class="text-success">Rp {{ number_format($barang->harga_sewa_per_hari, 0, ',', '.') }}/hari</h4>
            @endif

            <hr>

            <form action="{{ route('cart.add', $barang) }}" method="POST" class="add-to-cart-form">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="jumlah" class="col-form-label">Jumlah:</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" id="jumlah" name="jumlah" class="form-control" value="1" min="1" max="{{ $barang->jumlah_tersedia }}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

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
                    $('#cart-count').text(response.cart_count);
                    alert('Barang ditambahkan ke keranjang!');
                },
                error: function(xhr) {
                    alert('Gagal: ' + xhr.responseJSON.message);
                }
            });
        });
    });
</script>
@endpush
@endsection