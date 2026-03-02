@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran - PINVET Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Verifikasi Pembayaran</h1>
    <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <h5>Detail Pembayaran</h5>
        <table class="table table-bordered mb-4">
            <tr>
                <th style="width:200px;">Peminjaman</th>
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
                <th>Metode</th>
                <td>{{ $pembayaran->metode_pembayaran }}</td>
            </tr>
            <tr>
                <th>Tanggal Bayar</th>
                <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d/m/Y') }}</td>
            </tr>
            @if($pembayaran->bukti_pembayaran)
            <tr>
                <th>Bukti</th>
                <td>
                    <a href="{{ asset('storage/'.$pembayaran->bukti_pembayaran) }}" target="_blank">
                        <img src="{{ asset('storage/'.$pembayaran->bukti_pembayaran) }}" height="100" alt="">
                    </a>
                </td>
            </tr>
            @endif
        </table>

        <form action="{{ route('admin.pembayaran.update', $pembayaran) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="status_verifikasi" class="form-label">Status Verifikasi</label>
                <select name="status_verifikasi" id="status_verifikasi" class="form-select @error('status_verifikasi') is-invalid @enderror" required>
                    <option value="pending" {{ old('status_verifikasi', $pembayaran->status_verifikasi) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="verified" {{ old('status_verifikasi', $pembayaran->status_verifikasi) == 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="rejected" {{ old('status_verifikasi', $pembayaran->status_verifikasi) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                @error('status_verifikasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan (opsional)</label>
                <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="3">{{ old('catatan', $pembayaran->catatan) }}</textarea>
                @error('catatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Verifikasi</button>
        </form>
    </div>
</div>
@endsection