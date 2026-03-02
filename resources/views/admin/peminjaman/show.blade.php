@extends('layouts.admin')

@section('title', 'Detail Peminjaman - PINVET Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Detail Peminjaman</h1>
    <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>Informasi Peminjaman</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th>Nomor Surat Internal</th>
                        <td>{{ $peminjaman->nomor_surat_internal ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Surat Eksternal</th>
                        <td>{{ $peminjaman->nomor_surat_eksternal ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tipe Peminjam</th>
                        <td>{{ ucfirst($peminjaman->tipe_peminjam) }}</td>
                    </tr>
                    <tr>
                        <th>Nama Peminjam</th>
                        <td>{{ $peminjaman->nama_peminjam }}</td>
                    </tr>
                    @if($peminjaman->nim_peminjam)
                    <tr>
                        <th>NIM</th>
                        <td>{{ $peminjaman->nim_peminjam }}</td>
                    </tr>
                    @endif
                    @if($peminjaman->jabatan_peminjam)
                    <tr>
                        <th>Jabatan</th>
                        <td>{{ $peminjaman->jabatan_peminjam }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Instansi</th>
                        <td>{{ $peminjaman->instansi_peminjam }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th>Kontak</th>
                        <td>{{ $peminjaman->kontak_peminjam }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $peminjaman->email_peminjam ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pinjam</th>
                        <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Kembali</th>
                        <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Durasi (hari)</th>
                        <td>{{ $peminjaman->durasi_hari }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @php
                                $badge = [
                                    'pending' => 'warning',
                                    'disetujui' => 'info',
                                    'ditolak' => 'danger',
                                    'ongoing' => 'primary',
                                    'dikembalikan' => 'success',
                                    'terlambat' => 'dark'
                                ][$peminjaman->status_peminjaman] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ $peminjaman->status_peminjaman }}</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @if($peminjaman->catatan)
        <div class="mt-3">
            <h6>Catatan:</h6>
            <p>{{ $peminjaman->catatan }}</p>
        </div>
        @endif
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>Daftar Barang</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Sewa/Unit</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman->details as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->barang->nama_barang }}</td>
                    <td>{{ $detail->jumlah_barang }}</td>
                    <td>Rp {{ number_format($detail->harga_sewa_per_unit, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($detail->subtotal_sewa, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-end">Total Biaya Sewa</th>
                    <th>Rp {{ number_format($peminjaman->biaya_sewa_total, 0, ',', '.') }}</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-end">Status Pembayaran</th>
                    <th>
                        <span class="badge bg-{{ $peminjaman->status_pembayaran == 'lunas' ? 'success' : 'warning' }}">
                            {{ $peminjaman->status_pembayaran }}
                        </span>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>Riwayat Status</h5>
    </div>
    <div class="card-body">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Status Sebelumnya</th>
                    <th>Status Baru</th>
                    <th>Diubah Oleh</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman->riwayat as $r)
                <tr>
                    <td>{{ $r->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $r->status_sebelumnya ?? '-' }}</td>
                    <td>{{ $r->status_terbaru }}</td>
                    <td>{{ $r->user->name ?? 'Sistem' }}</td>
                    <td>{{ $r->keterangan ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Ubah Status</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.peminjaman.updateStatus', $peminjaman) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <select name="status" class="form-select" required>
                        <option value="">Pilih Status</option>
                        <option value="pending" {{ $peminjaman->status_peminjaman == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="disetujui" {{ $peminjaman->status_peminjaman == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ $peminjaman->status_peminjaman == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="ongoing" {{ $peminjaman->status_peminjaman == 'ongoing' ? 'selected' : '' }}>Ongoing (Sedang Dipinjam)</option>
                        <option value="dikembalikan" {{ $peminjaman->status_peminjaman == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        <option value="terlambat" {{ $peminjaman->status_peminjaman == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="text" name="keterangan" class="form-control" placeholder="Keterangan (opsional)">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Update Status</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection