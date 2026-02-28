@extends('layouts.admin')

@section('title', 'Daftar Barang - PINVET Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Daftar Barang</h1>
    <a href="{{ route('admin.barang.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Barang
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Kondisi</th>
                    <th>Harga Sewa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangs as $index => $barang)
                <tr>
                    <td>{{ $barangs->firstItem() + $index }}</td>
                    <td>
                        @if($barang->gambar_barang)
                            <img src="{{ asset('storage/'.$barang->gambar_barang) }}" width="50" height="50" style="object-fit: cover;">
                        @else
                            <span class="text-muted">Tidak ada</span>
                        @endif
                    </td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->kategori->nama }}</td>
                    <td>{{ $barang->jumlah_tersedia }}/{{ $barang->jumlah_total }}</td>
                    <td>
                        <span class="badge bg-{{ $barang->kondisi_barang == 'baik' ? 'success' : ($barang->kondisi_barang == 'rusak' ? 'danger' : 'warning') }}">
                            {{ $barang->kondisi_barang }}
                        </span>
                    </td>
                    <td>
                        @if($barang->dapat_disewa)
                            Rp {{ number_format($barang->harga_sewa_per_hari, 0, ',', '.') }}/hari
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.barang.show', $barang) }}" class="btn btn-sm btn-info" title="Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.barang.edit', $barang) }}" class="btn btn-sm btn-warning" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.barang.destroy', $barang) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus barang?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data barang.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $barangs->links() }}
        </div>
    </div>
</div>
@endsection