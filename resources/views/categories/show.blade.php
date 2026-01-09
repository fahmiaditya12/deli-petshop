@extends('layouts.app')

@section('title', 'Detail Kategori')
@section('page-title', 'Detail Kategori')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-folder me-2"></i> Detail Kategori</h1>
        <div class="btn-group" role="group">
            <a href="{{ route('categories.edit', $category) }}" 
               class="btn btn-warning" 
               data-bs-toggle="tooltip" 
               title="Edit Kategori">
                <i class="fas fa-edit me-2"></i> Edit
            </a>
            <a href="{{ route('categories.index') }}" 
               class="btn btn-secondary" 
               data-bs-toggle="tooltip" 
               title="Kembali ke Daftar">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="table-card">
            <h5 class="mb-3">Informasi Kategori</h5>
            <table class="table">
                <tr>
                    <th>Nama</th>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $category->description ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jumlah Produk</th>
                    <td><span class="badge bg-primary">{{ $category->products->count() }} Produk</span></td>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="table-card">
            <h5 class="mb-3">Daftar Produk</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($category->products as $index => $product)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada produk</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection