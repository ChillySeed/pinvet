@extends('layouts.admin')

@section('title', 'Daftar Peminjaman - PINVET Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Daftar Peminjaman</h1>
    <form method="GET" class="d-flex">
        <select name="status" class="form-select me-2" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
            <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            <option value="terlambat" {{ request('status') == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
        </select>
        <input type="text" name="search" class="form-control" placeholder="Cari nama/nomor surat" value="{{ request('search') }}">
        <button class="btn btn-primary ms-2" type="submit"><i class="fas fa-search"></i></button>
    </form>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Nama Peminjam</th>
                    <th>Instansi</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $index => $p)
                <tr>
                    <td>{{ $peminjamans->firstItem() + $index }}</td>
                    <td>{{ $p->nomor_surat ?? $p->nomor_surat_eksternal ?? $p->nomor_surat_internal ?? '-' }}</td>
                    <td>{{ $p->nama_peminjam }}</td>
                    <td>{{ $p->instansi_peminjam }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d/m/Y') }}</td>
                    <td>
                        @php
                            $badge = [
                                'pending' => 'warning',
                                'disetujui' => 'info',
                                'ditolak' => 'danger',
                                'ongoing' => 'primary',
                                'dikembalikan' => 'success',
                                'terlambat' => 'dark'
                            ][$p->status_peminjaman] ?? 'secondary';
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ $p->status_peminjaman }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.peminjaman.show', $p) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $peminjamans->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection