@extends('layouts.admin')

@section('title', 'Detail User - PINVET Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Detail User</h1>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th style="width:200px;">Nama</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Admin</th>
                <td>{{ $user->is_admin ? 'Ya' : 'Tidak' }}</td>
            </tr>
            <tr>
                <th>Terdaftar</th>
                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        </table>
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" {{ $user->id == auth()->id() ? 'disabled' : '' }}>Hapus</button>
        </form>
    </div>
</div>
@endsection