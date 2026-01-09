@extends('layouts.app')

@section('title', 'Kategori Produk')
@section('page-title', 'Kategori Produk')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-folder me-2"></i> Kategori Produk</h1>
            <p class="text-muted mb-0">Kelola kategori produk petshop</p>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-gradient">
            <i class="fas fa-plus-circle me-2"></i> Tambah Kategori
        </a>
    </div>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Produk</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $category)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $category->name }}</strong></td>
                    <td>{{ $category->description ?? '-' }}</td>
                    <td>
                        <span class="badge bg-primary">{{ $category->products_count }} Produk</span>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('categories.show', $category) }}" 
                               class="btn btn-sm btn-info" 
                               data-bs-toggle="tooltip" 
                               title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('categories.edit', $category) }}" 
                               class="btn btn-sm btn-warning" 
                               data-bs-toggle="tooltip" 
                               title="Edit Kategori">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-danger" 
                                        data-bs-toggle="tooltip" 
                                        title="Hapus Kategori"
                                        onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                        Belum ada data kategori
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection