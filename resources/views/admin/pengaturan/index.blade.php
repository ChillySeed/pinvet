@extends('layouts.admin')

@section('title', 'Pengaturan - PINVET Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Pengaturan</h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @php
                $settings = $settings ?? collect();
            @endphp

            <h5 class="mt-3">Informasi UKM</h5>
            <hr>
            <div class="mb-3">
                <label class="form-label">Nama UKM</label>
                <input type="text" name="nama_ukm" class="form-control" value="{{ $settings['nama_ukm']->value ?? '' }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat UKM</label>
                <textarea name="alamat_ukm" class="form-control">{{ $settings['alamat_ukm']->value ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Penandatangan</label>
                <input type="text" name="nama_penandatangan" class="form-control" value="{{ $settings['nama_penandatangan']->value ?? '' }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Jabatan Penandatangan</label>
                <input type="text" name="jabatan_penandatangan" class="form-control" value="{{ $settings['jabatan_penandatangan']->value ?? '' }}">
            </div>

            <h5 class="mt-4">Surat</h5>
            <hr>
            <div class="mb-3">
                <label class="form-label">Format Nomor Surat Internal</label>
                <input type="text" name="internal_nomor_format" class="form-control" value="{{ $settings['internal_nomor_format']->value ?? '{nomor_urut:03d}.{kode_ukm}/R.{kode_divisi}/RIPTEK/{bulan_romawi}/{tahun}' }}">
                <div class="form-text">Gunakan placeholder: {nomor_urut}, {kode_ukm}, {kode_divisi}, {bulan_romawi}, {tahun}</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Template Surat</label>
                <textarea name="surat_template" class="form-control" rows="10">{{ $settings['surat_template']->value ?? '' }}</textarea>
            </div>

            <h5 class="mt-4">Media</h5>
            <hr>
            <div class="mb-3">
                <label class="form-label">Logo</label>
                @if(isset($settings['logo']) && $settings['logo']->value)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$settings['logo']->value) }}" height="50" alt="">
                    </div>
                @endif
                <input type="file" name="logo" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
                <label class="form-label">Kop Surat</label>
                @if(isset($settings['kop_surat']) && $settings['kop_surat']->value)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$settings['kop_surat']->value) }}" height="50" alt="">
                    </div>
                @endif
                <input type="file" name="kop_surat" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
                <label class="form-label">Tanda Tangan</label>
                @if(isset($settings['ttd']) && $settings['ttd']->value)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$settings['ttd']->value) }}" height="50" alt="">
                    </div>
                @endif
                <input type="file" name="ttd" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
        </form>
    </div>
</div>
@endsection