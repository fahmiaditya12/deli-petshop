@extends('layouts.app')

@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-user-shield me-2"></i> Manajemen User</h1>
            <p class="text-muted mb-0">Kelola akun pengguna sistem</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-gradient">
            <i class="fas fa-user-plus me-2"></i> Tambah User
        </a>
    </div>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Terdaftar</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $user->name }}</strong>
                        @if($user->id === auth()->id())
                            <span class="badge bg-info ms-2">You</span>
                        @endif
                    </td>
                    <td><i class="fas fa-envelope me-1"></i> {{ $user->email }}</td>
                    <td>
                        @if($user->role === 'admin')
                            <span class="badge bg-danger"><i class="fas fa-crown me-1"></i> Admin</span>
                        @else
                            <span class="badge bg-primary"><i class="fas fa-user me-1"></i> Kasir</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('users.edit', $user) }}" 
                               class="btn btn-sm btn-warning" 
                               data-bs-toggle="tooltip" 
                               title="Edit User">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-danger" 
                                        data-bs-toggle="tooltip" 
                                        title="Hapus User"
                                        onclick="return confirm('Yakin ingin menghapus user ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i class="fas fa-users fa-3x mb-3 d-block"></i>
                        Belum ada data user
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection