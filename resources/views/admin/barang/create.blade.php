@extends('layouts.admin')

@section('title', 'Tambah Barang - PINVET Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Tambah Barang</h1>
    <a href="{{ route('admin.barang.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" required>
                @error('nama_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="pemilik_barang" class="form-label">Pemilik Barang</label>
                <input type="text" class="form-control @error('pemilik_barang') is-invalid @enderror" id="pemilik_barang" name="pemilik_barang" value="{{ old('pemilik_barang', 'UKM') }}">
                @error('pemilik_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="kategori_id" class="form-label">Kategori</label>
                <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jumlah_total" class="form-label">Jumlah Total</label>
                    <input type="number" class="form-control @error('jumlah_total') is-invalid @enderror" id="jumlah_total" name="jumlah_total" value="{{ old('jumlah_total') }}" min="0" required>
                    @error('jumlah_total')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jumlah_tersedia" class="form-label">Jumlah Tersedia</label>
                    <input type="number" class="form-control @error('jumlah_tersedia') is-invalid @enderror" id="jumlah_tersedia" name="jumlah_tersedia" value="{{ old('jumlah_tersedia') }}" min="0" required>
                    @error('jumlah_tersedia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="kondisi_barang" class="form-label">Kondisi Barang</label>
                <select class="form-select @error('kondisi_barang') is-invalid @enderror" id="kondisi_barang" name="kondisi_barang" required>
                    <option value="baik" {{ old('kondisi_barang') == 'baik' ? 'selected' : '' }}>Baik</option>
                    <option value="rusak ringan" {{ old('kondisi_barang') == 'rusak ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    <option value="rusak berat" {{ old('kondisi_barang') == 'rusak berat' ? 'selected' : '' }}>Rusak Berat</option>
                </select>
                @error('kondisi_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi_barang" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('deskripsi_barang') is-invalid @enderror" id="deskripsi_barang" name="deskripsi_barang" rows="3">{{ old('deskripsi_barang') }}</textarea>
                @error('deskripsi_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="gambar_barang" class="form-label">Gambar Barang</label>
                <input class="form-control @error('gambar_barang') is-invalid @enderror" type="file" id="gambar_barang" name="gambar_barang" accept="image/*">
                <div class="form-text">Maksimal 2MB, format: jpg, jpeg, png</div>
                @error('gambar_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="dapat_disewa" name="dapat_disewa" value="1" {{ old('dapat_disewa') ? 'checked' : '' }}>
                <label class="form-check-label" for="dapat_disewa">Dapat Disewakan</label>
            </div>

            <div class="mb-3" id="harga_sewa_field" style="display: {{ old('dapat_disewa') ? 'block' : 'none' }};">
                <label for="harga_sewa_per_hari" class="form-label">Harga Sewa per Hari (Rp)</label>
                <input type="number" class="form-control @error('harga_sewa_per_hari') is-invalid @enderror" id="harga_sewa_per_hari" name="harga_sewa_per_hari" value="{{ old('harga_sewa_per_hari') }}" min="0">
                @error('harga_sewa_per_hari')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $('#dapat_disewa').change(function() {
        if($(this).is(':checked')) {
            $('#harga_sewa_field').show();
        } else {
            $('#harga_sewa_field').hide();
        }
    });
</script>
@endpush
@endsection