@extends('layouts.admin')

@section('title', 'Dashboard - PINVET Admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Barang</h5>
                <p class="card-text display-6">{{ $totalBarang }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Peminjaman Aktif</h5>
                <p class="card-text display-6">{{ $totalPeminjamanAktif }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Total User</h5>
                <p class="card-text display-6">{{ $totalUser }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <h5 class="card-title">Pending</h5>
                <p class="card-text display-6">{{ $peminjamanPending }}</p>
            </div>
        </div>
    </div>
</div>
@endsection