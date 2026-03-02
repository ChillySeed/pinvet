@extends('layouts.admin')

@section('title', 'Detail Pembayaran - PINVET Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Detail Pembayaran</h1>
    <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th style="width:200px;">ID</th>
                <td>{{ $pembayaran->id }}</td>
            </tr>
            <tr>
                <th>Peminjaman</th>
                <td>
                    <a href="{{ route('admin.peminjaman.show', $pembayaran->peminjaman) }}">
                        {{ $pembayaran->peminjaman->nomor_surat ?? $pembayaran->peminjaman->nama_peminjam }}
                    </a>
                </td>
            </tr>
            <tr>
                <th>Jumlah Bayar</th>
                <td>Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Metode Pembayaran</th>
                <td>{{ $pembayaran->metode_pembayaran }}</td>
            </tr>
            <tr>
                <th>Tanggal Bayar</th>
                <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Status Verifikasi</th>
                <td>
                    @php
                        $badge = [
                            'pending' => 'warning',
                            'verified' => 'success',
                            'rejected' => 'danger'
                        ][$pembayaran->status_verifikasi] ?? 'secondary';
                    @endphp
                    <span class="badge bg-{{ $badge }}">{{ $pembayaran->status_verifikasi }}</span>
                </td>
            </tr>
            <tr>
                <th>Verifikator</th>
                <td>{{ $pembayaran->verifikator->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Catatan</th>
                <td>{{ $pembayaran->catatan ?? '-' }}</td>
            </tr>
            @if($pembayaran->bukti_pembayaran)
            <tr>
                <th>Bukti Pembayaran</th>
                <td>
                    <a href="{{ asset('storage/'.$pembayaran->bukti_pembayaran) }}" target="_blank">
                        <img src="{{ asset('storage/'.$pembayaran->bukti_pembayaran) }}" height="200" alt="">
                    </a>
                </td>
            </tr>
            @endif
        </table>

        <a href="{{ route('admin.pembayaran.edit', $pembayaran) }}" class="btn btn-warning">Verifikasi / Edit</a>
    </div>
</div>
@endsection