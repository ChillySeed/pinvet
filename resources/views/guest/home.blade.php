@extends('layouts.guest')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4">
                    PINVET
                    <span class="text-warning">Sistem Peminjaman Inventaris</span>
                </h1>
                <p class="lead mb-4">
                    Solusi digital untuk memudahkan peminjaman alat dan inventaris UKM. 
                    Cepat, mudah, dan terintegrasi dalam satu platform.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('guest.katalog.index') }}" 
                         class="btn btn-start">
                        <i class="fas fa-play-circle me-2"></i>Start Peminjaman
                    </a>
                    <a href="{{ route('guest.katalog.index') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-boxes me-2"></i>Lihat Katalog
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-5 fw-bold">Kenapa Memilih PINVET?</h2>
                <p class="lead text-muted">Fitur-fitur unggulan yang memudahkan Anda</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-boxes fa-3x text-primary"></i>
                        </div>
                        <h4>Manajemen Barang</h4>
                        <p class="text-muted">Kelola inventaris dengan sistem stok real-time dan katalog digital.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-handshake fa-3x text-success"></i>
                        </div>
                        <h4>Dual Mode</h4>
                        <p class="text-muted">Internal untuk anggota UKM, eksternal untuk organisasi lain.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-file-pdf fa-3x text-danger"></i>
                        </div>
                        <h4>Surat Otomatis</h4>
                        <p class="text-muted">Generate surat peminjaman otomatis dalam format PDF.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="display-5 fw-bold mb-4">Siap Meminjam?</h2>
        <p class="lead mb-5">Mulai peminjaman Anda sekarang dan nikmati kemudahan sistem digital kami.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('guest.katalog.index') }}" 
                class="btn btn-light btn-lg px-5">
                    <i class="fas fa-handshake me-2"></i>Mulai Peminjaman
                </a>
             <a href="{{ route('guest.cart.index') }}" 
                class="btn btn-outline-light btn-lg px-5">
                    <i class="fas fa-shopping-cart me-2"></i>Lihat Keranjang
            </a>
        </div>
    </div>
</section>

<style>
.hero-section {
    padding: 120px 0;
}
</style>
@endsection