@extends('layouts.guest')

@section('title', 'Pilih Tipe Peminjam - PINVET')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">Pilih Tipe Peminjam</h2>
                    <p class="text-center text-muted mb-5">Silakan pilih sesuai status Anda</p>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('peminjaman.form', 'internal') }}" class="text-decoration-none">
                                <div class="card h-100 border-primary">
                                    <div class="card-body text-center p-4">
                                        <div class="bg-primary bg-gradient text-white rounded-circle mx-auto mb-3" 
                                             style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-users fa-3x"></i>
                                        </div>
                                        <h4 class="text-primary">Internal</h4>
                                        <p class="text-muted">Untuk anggota UKM</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('peminjaman.form', 'eksternal') }}" class="text-decoration-none">
                                <div class="card h-100 border-success">
                                    <div class="card-body text-center p-4">
                                        <div class="bg-success bg-gradient text-white rounded-circle mx-auto mb-3" 
                                             style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-globe fa-3x"></i>
                                        </div>
                                        <h4 class="text-success">Eksternal</h4>
                                        <p class="text-muted">Untuk umum, organisasi lain</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection