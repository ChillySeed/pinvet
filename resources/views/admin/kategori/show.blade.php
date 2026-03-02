@extends('layouts.admin')

@section('title', 'Detail Kategori - PINVET Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Detail Kategori</h1>
    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th style="width:200px;">Nama Kategori</th>
                <td>{{ $kategori->nama }}</td>
            </tr>
            <tr>
                <th>Slug</th>
                <td>{{ $kategori->slug }}</td>
            </tr>
            <tr>
                <th>Jumlah Barang</th>
                <td>{{ $kategori->barangs->count() }}</td>
            </tr>
        </table>
        <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
        </form>
    </div>
</div>
@endsection