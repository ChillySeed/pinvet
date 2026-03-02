@extends('layouts.admin')

@section('title', 'Edit Kategori - PINVET Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Edit Kategori</h1>
    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $kategori->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection