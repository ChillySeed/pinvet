@extends('layouts.admin')

@section('title', 'Daftar Kategori - PINVET Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Daftar Kategori</h1>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Kategori
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Slug</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategoris as $index => $kategori)
                <tr>
                    <td>{{ $kategoris->firstItem() + $index }}</td>
                    <td>{{ $kategori->nama }}</td>
                    <td>{{ $kategori->slug }}</td>
                    <td>
                        <a href="{{ route('admin.kategori.show', $kategori) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus kategori?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $kategoris->links() }}
        </div>
    </div>
</div>
@endsection