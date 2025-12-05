@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Dashboard Admin</h1>
    
    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_barang'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Peminjaman</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_peminjaman'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Peminjaman Pending</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['peminjaman_pending'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Peminjaman Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['peminjaman_aktif'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sync fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Peminjaman -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Peminjaman Terbaru</h6>
            <a href="{{ route('admin.peminjaman.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Tambah Peminjaman
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recent_peminjaman as $index => $peminjaman)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $peminjaman->nama_peminjam }}</td>
                            <td>{{ $peminjaman->tanggal_pinjam->format('d-m-Y') }}</td>
                            <td>{{ $peminjaman->tanggal_kembali->format('d-m-Y') }}</td>
                            <td>
                                @php
                                    $statusClasses = [
                                        'pending' => 'warning',
                                        'disetujui' => 'success',
                                        'ditolak' => 'danger',
                                        'dipinjam' => 'primary',
                                        'dikembalikan' => 'info',
                                        'terlambat' => 'danger'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statusClasses[$peminjaman->status_peminjaman] }}">
                                    {{ ucfirst($peminjaman->status_peminjaman) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.peminjaman.show', $peminjaman->id_peminjaman) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection