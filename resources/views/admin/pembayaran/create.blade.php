@extends('layouts.admin')

@section('title', 'Catat Pembayaran - PINVET Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Catat Pembayaran</h1>
    <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="peminjaman_id" class="form-label">Pilih Peminjaman</label>
                <select name="peminjaman_id" id="peminjaman_id" class="form-select @error('peminjaman_id') is-invalid @enderror" required>
                    <option value="">-- Pilih --</option>
                    @foreach($peminjamans as $p)
                        <option value="{{ $p->id }}" {{ old('peminjaman_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->nomor_surat ?? $p->nama_peminjam }} - {{ $p->instansi_peminjam }} (Total: Rp {{ number_format($p->biaya_sewa_total,0,',','.') }})
                        </option>
                    @endforeach
                </select>
                @error('peminjaman_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jumlah_bayar" class="form-label">Jumlah Bayar (Rp)</label>
                <input type="number" class="form-control @error('jumlah_bayar') is-invalid @enderror" id="jumlah_bayar" name="jumlah_bayar" value="{{ old('jumlah_bayar') }}" min="0" required>
                @error('jumlah_bayar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" class="form-select @error('metode_pembayaran') is-invalid @enderror" required>
                    <option value="">Pilih Metode</option>
                    <option value="tunai" {{ old('metode_pembayaran') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                    <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                    <option value="qris" {{ old('metode_pembayaran') == 'qris' ? 'selected' : '' }}>QRIS</option>
                </select>
                @error('metode_pembayaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                <input type="date" class="form-control @error('tanggal_bayar') is-invalid @enderror" id="tanggal_bayar" name="tanggal_bayar" value="{{ old('tanggal_bayar', now()->format('Y-m-d')) }}" required>
                @error('tanggal_bayar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran (opsional)</label>
                <input type="file" class="form-control @error('bukti_pembayaran') is-invalid @enderror" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*">
                @error('bukti_pembayaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection