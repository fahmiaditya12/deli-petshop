@extends('layouts.app')

@section('title', 'Detail Produk')
@section('page-title', 'Detail Produk')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-box me-2"></i> Detail Produk</h1>
        <div class="btn-group" role="group">
            <a href="{{ route('products.edit', $product) }}" 
               class="btn btn-warning" 
               data-bs-toggle="tooltip" 
               title="Edit Produk">
                <i class="fas fa-edit me-2"></i> Edit
            </a>
            <a href="{{ route('products.index') }}" 
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
            <h5 class="mb-3">Gambar Produk</h5>
            @if($product->getImageUrl())
                <img src="{{ $product->getImageUrl() }}" alt="{{ $product->name }}" 
                     class="img-fluid rounded mb-3" style="max-height: 400px; width: 100%; object-fit: cover;"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center mb-3" 
                     style="height: 300px; display: none;">
                    <div class="text-center">
                        <i class="fas fa-image fa-4x mb-3 d-block"></i>
                        <p class="mb-0">Gambar tidak dapat dimuat</p>
                    </div>
                </div>
            @else
                <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center mb-3" 
                     style="height: 300px;">
                    <div class="text-center">
                        <i class="fas fa-image fa-4x mb-3 d-block"></i>
                        <p class="mb-0">Tidak ada gambar</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="table-card">
            <h5 class="mb-3">Informasi Produk</h5>
            <table class="table">
                <tr>
                    <th width="30%">Nama Produk</th>
                    <td><strong>{{ $product->name }}</strong></td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>
                        <span class="badge bg-secondary">{{ $product->category->name }}</span>
                    </td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>
                        <h4 class="text-primary mb-0">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>
                    </td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td>
                        @if($product->stock <= 10)
                            <span class="badge bg-warning fs-6">{{ $product->stock }} Unit</span>
                            <small class="text-warning d-block mt-1">
                                <i class="fas fa-exclamation-triangle"></i> Stok menipis!
                            </small>
                        @else
                            <span class="badge bg-success fs-6">{{ $product->stock }} Unit</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $product->description ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Dibuat</th>
                    <td>{{ $product->created_at->format('d F Y, H:i') }}</td>
                </tr>
                <tr>
                    <th>Terakhir Diupdate</th>
                    <td>{{ $product->updated_at->format('d F Y, H:i') }}</td>
                </tr>
            </table>
        </div>
        
        <div class="table-card mt-3">
            <h5 class="mb-3">Aksi</h5>
            <div class="btn-group" role="group">
                <a href="{{ route('products.edit', $product) }}" 
                   class="btn btn-warning" 
                   data-bs-toggle="tooltip" 
                   title="Edit Produk">
                    <i class="fas fa-edit me-2"></i> Edit Produk
                </a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn btn-danger" 
                            data-bs-toggle="tooltip" 
                            title="Hapus Produk"
                            onclick="return confirm('Yakin ingin menghapus produk ini?')">
                        <i class="fas fa-trash me-2"></i> Hapus Produk
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

