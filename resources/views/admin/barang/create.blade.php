@extends('layouts.admin')

@section('title', 'Tambah Barang Baru')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0">Tambah Barang Baru</h2>
        <a href="{{ route('admin.barang.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang *</label>
                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" 
                                       id="nama_barang" name="nama_barang" 
                                       value="{{ old('nama_barang') }}" required>
                                @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="pemilik_barang" class="form-label">Pemilik Barang *</label>
                                <input type="text" class="form-control @error('pemilik_barang') is-invalid @enderror" 
                                       id="pemilik_barang" name="pemilik_barang" 
                                       value="{{ old('pemilik_barang', 'UKM') }}" required>
                                @error('pemilik_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kategori_barang" class="form-label">Kategori *</label>
                                <select class="form-control @error('kategori_barang') is-invalid @enderror" 
                                        id="kategori_barang" name="kategori_barang" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="elektronik" {{ old('kategori_barang') == 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                                    <option value="furniture" {{ old('kategori_barang') == 'furniture' ? 'selected' : '' }}>Furniture</option>
                                    <option value="olahraga" {{ old('kategori_barang') == 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                                    <option value="alat_tulis" {{ old('kategori_barang') == 'alat_tulis' ? 'selected' : '' }}>Alat Tulis</option>
                                    <option value="lainnya" {{ old('kategori_barang') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('kategori_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="kondisi_barang" class="form-label">Kondisi Barang *</label>
                                <select class="form-control @error('kondisi_barang') is-invalid @enderror" 
                                        id="kondisi_barang" name="kondisi_barang" required>
                                    <option value="baik" {{ old('kondisi_barang') == 'baik' ? 'selected' : '' }}>Baik</option>
                                    <option value="rusak_ringan" {{ old('kondisi_barang') == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                    <option value="rusak_berat" {{ old('kondisi_barang') == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                                </select>
                                @error('kondisi_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jumlah_total" class="form-label">Jumlah Total *</label>
                                <input type="number" class="form-control @error('jumlah_total') is-invalid @enderror" 
                                       id="jumlah_total" name="jumlah_total" min="1" 
                                       value="{{ old('jumlah_total', 1) }}" required>
                                @error('jumlah_total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="jumlah_tersedia" class="form-label">Jumlah Tersedia *</label>
                                <input type="number" class="form-control @error('jumlah_tersedia') is-invalid @enderror" 
                                       id="jumlah_tersedia" name="jumlah_tersedia" min="0" 
                                       value="{{ old('jumlah_tersedia', 1) }}" required>
                                @error('jumlah_tersedia')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="deskripsi_barang" class="form-label">Deskripsi Barang</label>
                            <textarea class="form-control @error('deskripsi_barang') is-invalid @enderror" 
                                      id="deskripsi_barang" name="deskripsi_barang" 
                                      rows="3">{{ old('deskripsi_barang') }}</textarea>
                            @error('deskripsi_barang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="lokasi_penyimpanan" class="form-label">Lokasi Penyimpanan *</label>
                            <input type="text" class="form-control @error('lokasi_penyimpanan') is-invalid @enderror" 
                                   id="lokasi_penyimpanan" name="lokasi_penyimpanan" 
                                   value="{{ old('lokasi_penyimpanan') }}" required>
                            @error('lokasi_penyimpanan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="gambar_barang" class="form-label">Gambar Barang</label>
                            <div class="border rounded p-3 text-center mb-3" id="imagePreviewContainer">
                                <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                <p class="text-muted">Preview gambar akan muncul di sini</p>
                                <img id="imagePreview" src="" alt="Preview" class="img-fluid d-none">
                            </div>
                            <input type="file" class="form-control @error('gambar_barang') is-invalid @enderror" 
                                   id="gambar_barang" name="gambar_barang" 
                                   accept="image/*" onchange="previewImage(event)">
                            @error('gambar_barang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" 
                                       id="dapat_disewa" name="dapat_disewa" value="1"
                                       {{ old('dapat_disewa') ? 'checked' : '' }}>
                                <label class="form-check-label" for="dapat_disewa">
                                    Dapat Disewakan
                                </label>
                            </div>
                        </div>
                        
                        <div class="mb-3" id="hargaSewaContainer" style="display: none;">
                            <label for="harga_sewa_per_hari" class="form-label">Harga Sewa per Hari (Rp)</label>
                            <input type="number" class="form-control @error('harga_sewa_per_hari') is-invalid @enderror" 
                                   id="harga_sewa_per_hari" name="harga_sewa_per_hari" 
                                   min="0" step="1000" 
                                   value="{{ old('harga_sewa_per_hari', 0) }}">
                            @error('harga_sewa_per_hari')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <button type="reset" class="btn btn-secondary me-2">
                        <i class="fas fa-redo me-1"></i>Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Simpan Barang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
function previewImage(event) {
    const reader = new FileReader();
    const imagePreview = document.getElementById('imagePreview');
    const container = document.getElementById('imagePreviewContainer');
    
    reader.onload = function() {
        imagePreview.src = reader.result;
        imagePreview.classList.remove('d-none');
        container.querySelector('i').style.display = 'none';
        container.querySelector('p').style.display = 'none';
    }
    
    if (event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
}

document.getElementById('dapat_disewa').addEventListener('change', function() {
    const hargaContainer = document.getElementById('hargaSewaContainer');
    const hargaInput = document.getElementById('harga_sewa_per_hari');
    
    if (this.checked) {
        hargaContainer.style.display = 'block';
        hargaInput.required = true;
    } else {
        hargaContainer.style.display = 'none';
        hargaInput.required = false;
        hargaInput.value = 0;
    }
});

// Inisialisasi kondisi awal
document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('dapat_disewa');
    if (checkbox.checked) {
        document.getElementById('hargaSewaContainer').style.display = 'block';
    }
});
</script>
@endsection
@endsection