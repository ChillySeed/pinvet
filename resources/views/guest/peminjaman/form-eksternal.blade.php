@extends('layouts.guest')

@section('title', 'Form Peminjaman Eksternal - PINVET')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">Form Peminjaman Eksternal</h2>
                    <p class="text-center text-muted mb-4">Isi data Anda sebagai peminjam eksternal</p>

                    <form action="{{ route('peminjaman.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tipe" value="eksternal">

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap / Penanggung Jawab</label>
                            <input type="text" name="nama_peminjam" class="form-control @error('nama_peminjam') is-invalid @enderror" 
                                   value="{{ old('nama_peminjam') }}" required>
                            @error('nama_peminjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Instansi/Organisasi/Perusahaan</label>
                            <input type="text" name="instansi_peminjam" class="form-control @error('instansi_peminjam') is-invalid @enderror" 
                                   value="{{ old('instansi_peminjam') }}" required>
                            @error('instansi_peminjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kontak (No. HP/WA)</label>
                                <input type="text" name="kontak_peminjam" class="form-control @error('kontak_peminjam') is-invalid @enderror" 
                                       value="{{ old('kontak_peminjam') }}" required>
                                @error('kontak_peminjam')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email_peminjam" class="form-control @error('email_peminjam') is-invalid @enderror" 
                                       value="{{ old('email_peminjam') }}" required>
                                @error('email_peminjam')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Pinjam</label>
                                <input type="date" name="tanggal_pinjam" class="form-control @error('tanggal_pinjam') is-invalid @enderror" 
                                       value="{{ old('tanggal_pinjam', now()->format('Y-m-d')) }}" required>
                                @error('tanggal_pinjam')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Kembali</label>
                                <input type="date" name="tanggal_kembali" class="form-control @error('tanggal_kembali') is-invalid @enderror" 
                                       value="{{ old('tanggal_kembali', now()->addDays(3)->format('Y-m-d')) }}" required>
                                @error('tanggal_kembali')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor Surat Eksternal (jika ada)</label>
                            <input type="text" name="nomor_surat_eksternal" class="form-control @error('nomor_surat_eksternal') is-invalid @enderror" 
                                   value="{{ old('nomor_surat_eksternal') }}" placeholder="Isi jika Anda punya format surat sendiri">
                            @error('nomor_surat_eksternal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catatan (opsional)</label>
                            <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="3">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success w-100">Lanjut ke Preview Surat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection