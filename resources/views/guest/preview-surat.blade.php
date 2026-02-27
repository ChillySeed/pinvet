@extends('layouts.guest')

@section('title', 'Preview Surat Peminjaman - PINVET')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">Preview Surat Peminjaman</h2>
                    <p class="text-center text-muted">Periksa kembali data Anda sebelum generate PDF.</p>

                    <!-- Kustomisasi Surat -->
                    <div class="alert alert-info">
                        <h5>Kustomisasi Surat</h5>
                        <p>Anda dapat mengubah beberapa elemen surat di bawah ini (opsional).</p>
                    </div>

                    <form action="{{ route('peminjaman.generate', $peminjaman->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            @if($peminjaman->tipe_peminjam == 'eksternal')
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor Surat Eksternal</label>
                                    <input type="text" name="nomor_surat_eksternal" class="form-control" 
                                           value="{{ $peminjaman->nomor_surat_eksternal ?? '' }}" 
                                           placeholder="Isi jika ingin menggunakan nomor sendiri">
                                </div>
                            @endif
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Penandatangan</label>
                                <input type="text" name="nama_penandatangan" class="form-control" 
                                       value="{{ old('nama_penandatangan', $settingNamaPenandatangan ?? 'Ketua UKM') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jabatan Penandatangan</label>
                                <input type="text" name="jabatan_penandatangan" class="form-control" 
                                       value="{{ old('jabatan_penandatangan', $settingJabatanPenandatangan ?? 'Ketua') }}">
                            </div>
                        </div>

                        <hr>

                        <!-- Preview Surat (HTML sederhana) -->
                        <div class="border p-4 mb-4" style="background: #f9f9f9;">
                            <div class="text-center mb-4">
                                <h4 class="fw-bold">SURAT PEMINJAMAN BARANG</h4>
                                <p class="text-muted">
                                    Nomor: <span id="previewNomor">{{ $peminjaman->nomor_surat_eksternal ?? $peminjaman->nomor_surat_internal ?? '(akan digenerate)' }}</span>
                                </p>
                            </div>
                            <p>Yang bertanda tangan di bawah ini:</p>
                            <p>Nama: <strong>{{ $peminjaman->nama_peminjam }}</strong></p>
                            @if($peminjaman->nim_peminjam)
                                <p>NIM: <strong>{{ $peminjaman->nim_peminjam }}</strong></p>
                            @endif
                            <p>Instansi: <strong>{{ $peminjaman->instansi_peminjam }}</strong></p>
                            <p>Dengan ini mengajukan peminjaman barang sebagai berikut:</p>
                            
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($peminjaman->details as $index => $detail)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $detail->barang->nama_barang }}</td>
                                            <td>{{ $detail->jumlah_barang }}</td>
                                            <td>{{ $peminjaman->tanggal_pinjam->format('d-m-Y') }}</td>
                                            <td>{{ $peminjaman->tanggal_kembali->format('d-m-Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            <p class="mt-4">Demikian surat ini dibuat untuk digunakan sebagaimana mestinya.</p>
                            <p class="mt-5">Hormat kami,</p>
                            <p class="mt-5"><span id="previewPenandatangan">{{ old('nama_penandatangan', $settingNamaPenandatangan ?? 'Ketua UKM') }}</span><br>
                            <span id="previewJabatan">{{ old('jabatan_penandatangan', $settingJabatanPenandatangan ?? 'Ketua') }}</span></p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('cart.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Keranjang
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-file-pdf"></i> Generate PDF & Selesai
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Update preview saat input berubah
    $('input[name="nama_penandatangan"]').on('input', function() {
        $('#previewPenandatangan').text($(this).val() || 'Ketua UKM');
    });
    $('input[name="jabatan_penandatangan"]').on('input', function() {
        $('#previewJabatan').text($(this).val() || 'Ketua');
    });
    @if($peminjaman->tipe_peminjam == 'eksternal')
        $('input[name="nomor_surat_eksternal"]').on('input', function() {
            $('#previewNomor').text($(this).val() || '{{ $peminjaman->nomor_surat_internal ?? "(akan digenerate)" }}');
        });
    @endif
</script>
@endpush
@endsection