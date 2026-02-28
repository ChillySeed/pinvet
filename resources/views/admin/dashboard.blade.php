@extends('layouts.admin')

@section('title', 'Dashboard - PINVET Admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Barang</h5>
                <p class="card-text display-6">{{ $totalBarang }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Peminjaman Aktif</h5>
                <p class="card-text display-6">{{ $totalPeminjamanAktif }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Total User</h5>
                <p class="card-text display-6">{{ $totalUser }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <h5 class="card-title">Pending</h5>
                <p class="card-text display-6">{{ $peminjamanPending }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Peminjaman Terbaru</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Peminjaman::latest()->take(5)->get() as $p)
                        <tr>
                            <td>{{ $p->nama_peminjam }}</td>
                            <td><span class="badge bg-{{ $p->status_peminjaman == 'pending' ? 'warning' : ($p->status_peminjaman == 'ongoing' ? 'primary' : 'success') }}">{{ $p->status_peminjaman }}</span></td>
                            <td>{{ $p->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Barang Stok Menipis</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Barang::where('jumlah_tersedia', '<', 3)->take(5)->get() as $b)
                        <tr>
                            <td>{{ $b->nama_barang }}</td>
                            <td>{{ $b->jumlah_tersedia }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection