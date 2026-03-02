@extends('layouts.admin')

@section('title', 'Daftar Pembayaran - PINVET Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Daftar Pembayaran</h1>
    <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Catat Pembayaran
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Peminjaman</th>
                    <th>Jumlah Bayar</th>
                    <th>Metode</th>
                    <th>Tanggal</th>
                    <th>Status Verifikasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pembayarans as $index => $p)
                <tr>
                    <td>{{ $pembayarans->firstItem() + $index }}</td>
                    <td>
                        <a href="{{ route('admin.peminjaman.show', $p->peminjaman) }}">
                            {{ $p->peminjaman->nomor_surat ?? $p->peminjaman->nama_peminjam }}
                        </a>
                    </td>
                    <td>Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                    <td>{{ $p->metode_pembayaran }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal_bayar)->format('d/m/Y') }}</td>
                    <td>
                        @php
                            $badge = [
                                'pending' => 'warning',
                                'verified' => 'success',
                                'rejected' => 'danger'
                            ][$p->status_verifikasi] ?? 'secondary';
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ $p->status_verifikasi }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.pembayaran.show', $p) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.pembayaran.edit', $p) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data pembayaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $pembayarans->links() }}
        </div>
    </div>
</div>
@endsection