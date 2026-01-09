@extends('layouts.app')

@section('title', 'Pelanggan')
@section('page-title', 'Pelanggan')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-users me-2"></i> Data Pelanggan</h1>
            <p class="text-muted mb-0">Kelola data pelanggan petshop</p>
        </div>
        <a href="{{ route('customers.create') }}" class="btn btn-gradient">
            <i class="fas fa-user-plus me-2"></i> Tambah Pelanggan
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
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Transaksi</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $index => $customer)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $customer->name }}</strong></td>
                    <td><i class="fas fa-phone me-1"></i> {{ $customer->phone }}</td>
                    <td>
                        @if($customer->email)
                            <i class="fas fa-envelope me-1"></i> {{ $customer->email }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ Str::limit($customer->address, 30) ?? '-' }}</td>
                    <td>
                        <span class="badge bg-primary">{{ $customer->transactions_count }} Transaksi</span>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('customers.show', $customer) }}" 
                               class="btn btn-sm btn-info" 
                               data-bs-toggle="tooltip" 
                               title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('customers.edit', $customer) }}" 
                               class="btn btn-sm btn-warning" 
                               data-bs-toggle="tooltip" 
                               title="Edit Pelanggan">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-danger" 
                                        data-bs-toggle="tooltip" 
                                        title="Hapus Pelanggan"
                                        onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        <i class="fas fa-users fa-3x mb-3 d-block"></i>
                        Belum ada data pelanggan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection