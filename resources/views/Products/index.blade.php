@extends('layouts.app')

@section('title', 'Produk')
@section('page-title', 'Produk')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-box me-2"></i> Data Produk</h1>
            <p class="text-muted mb-0">Kelola produk petshop</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-gradient">
            <i class="fas fa-plus-circle me-2"></i> Tambah Produk
        </a>
    </div>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if($product->getImageUrl())
                            <img src="{{ $product->getImageUrl() }}" alt="{{ $product->name }}" 
                                 class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                            <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center" 
                                 style="width: 50px; height: 50px;">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </td>
                    <td><strong>{{ $product->name }}</strong></td>
                    <td>
                        <span class="badge bg-secondary">
                            {{ $product->category?->name ?? 'Tanpa Kategori' }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>
                        @if($product->stock <= 10)
                            <span class="low-stock-badge">{{ $product->stock }}</span>
                        @else
                            <span class="badge bg-success">{{ $product->stock }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('products.show', $product) }}" 
                               class="btn btn-sm btn-info" 
                               data-bs-toggle="tooltip" 
                               title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('products.edit', $product) }}" 
                               class="btn btn-sm btn-warning" 
                               data-bs-toggle="tooltip" 
                               title="Edit Produk">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-danger" 
                                        data-bs-toggle="tooltip" 
                                        title="Hapus Produk"
                                        onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        <i class="fas fa-box-open fa-3x mb-3 d-block"></i>
                        Belum ada data produk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection