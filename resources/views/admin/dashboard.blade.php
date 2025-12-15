@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0">Dashboard</h2>
        <div class="btn-group">
            <button class="btn btn-primary"><i class="fas fa-plus me-2"></i>Tambah Barang</button>
            <button class="btn btn-outline-primary"><i class="fas fa-download me-2"></i>Export</button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Barang</h6>
                            <h2 class="mb-0">{{ $totalBarang }}</h2>
                        </div>
                        <i class="fas fa-boxes fa-3x opacity-50"></i>
                    </div>
                    <div class="mt-2">
                        <span class="small">Tersedia: {{ $barangTersedia }} unit</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card stat-card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Pengguna</h6>
                            <h2 class="mb-0">{{ $totalUsers }}</h2>
                        </div>
                        <i class="fas fa-users fa-3x opacity-50"></i>
                    </div>
                    <div class="mt-2">
                        <span class="small">Admin: {{ \App\Models\User::where('level_akses', 'admin')->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card stat-card bg-warning text-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Peminjaman</h6>
                            <h2 class="mb-0">{{ $totalPeminjaman }}</h2>
                        </div>
                        <i class="fas fa-handshake fa-3x opacity-50"></i>
                    </div>
                    <div class="mt-2">
                        <span class="small">Pending: {{ $pendingPeminjaman }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card stat-card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Rasio</h6>
                            <h2 class="mb-0">{{ number_format($barangTersedia > 0 ? ($totalPeminjaman / $barangTersedia) * 100 : 0, 1) }}%</h2>
                        </div>
                        <i class="fas fa-chart-line fa-3x opacity-50"></i>
                    </div>
                    <div class="mt-2">
                        <span class="small">Utilization Rate</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Barang Terbaru</h5>
                    <a href="{{ route('admin.barang.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Jumlah</th>
                                    <th>Kondisi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBarang as $barang)
                                <tr>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $barang->kategori_barang }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $barang->jumlah_tersedia }}/{{ $barang->jumlah_total }}</span>
                                    </td>
                                    <td>
                                        @php
                                            $statusColor = [
                                                'baik' => 'success',
                                                'rusak_ringan' => 'warning',
                                                'rusak_berat' => 'danger'
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $statusColor[$barang->kondisi_barang] ?? 'secondary' }}">
                                            {{ ucfirst(str_replace('_', ' ', $barang->kondisi_barang)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.barang.show', $barang->id_barang) }}" 
                                               class="btn btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.barang.edit', $barang->id_barang) }}" 
                                               class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data barang</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.barang.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Barang Baru
                        </a>
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-file-export me-2"></i>Generate Laporan
                        </button>
                        <button class="btn btn-outline-success">
                            <i class="fas fa-qrcode me-2"></i>Generate QR Code
                        </button>
                        <button class="btn btn-outline-warning">
                            <i class="fas fa-cog me-2"></i>Pengaturan Sistem
                        </button>
                    </div>
                    
                    <hr>
                    
                    <h6 class="mt-3">Status Sistem</h6>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Database</span>
                            <span class="badge bg-success">Online</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Storage</span>
                            <span class="badge bg-success">Normal</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Versi Sistem</span>
                            <span class="badge bg-info">v1.0.0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection