@extends('layouts.admin')

@section('title', 'Daftar User - PINVET Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Daftar User</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah User
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                <tr>
                    <td>{{ $users->firstItem() + $index }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->is_admin)
                            <span class="badge bg-success">Ya</span>
                        @else
                            <span class="badge bg-secondary">Tidak</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus user?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" {{ $user->id == auth()->id() ? 'disabled' : '' }}>
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data user.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection