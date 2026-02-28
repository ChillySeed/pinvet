@extends('layouts.admin')

@section('title', 'Detail Barang - PINVET Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Detail Barang</h1>
    <a href="{{ route('admin.barang.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                @if($barang->gambar_barang)
                    <img src="{{ asset('storage/'.$barang->gambar_barang) }}" class="img-fluid rounded" alt="">
                @else
                    <div class="bg-light text-center p-5">Tidak ada gambar</div>
                @endif
            </div>
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tr>
                        <th style="width:200px;">Nama Barang</th>
                        <td>{{ $barang->nama_barang }}</td>
                    </tr>
                    <tr>
                        <th>Pemilik</th>
                        <td>{{ $barang->pemilik_barang }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $barang->kategori->nama }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Total</th>
                        <td>{{ $barang->jumlah_total }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Tersedia</th>
                        <td>{{ $barang->jumlah_tersedia }}</td>
                    </tr>
                    <tr>
                        <th>Kondisi</th>
                        <td>{{ $barang->kondisi_barang }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $barang->deskripsi_barang ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Dapat Disewa</th>
                        <td>{{ $barang->dapat_disewa ? 'Ya' : 'Tidak' }}</td>
                    </tr>
                    @if($barang->dapat_disewa)
                    <tr>
                        <th>Harga Sewa per Hari</th>
                        <td>Rp {{ number_format($barang->harga_sewa_per_hari, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                </table>
                <a href="{{ route('admin.barang.edit', $barang) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('admin.barang.destroy', $barang) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection