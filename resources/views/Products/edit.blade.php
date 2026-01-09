@extends('layouts.app')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')
<div class="page-header">
    <h1><i class="fas fa-edit me-2"></i> Edit Produk</h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="table-card">
            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description', $product->description) }}</textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga <span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                               value="{{ old('price', $product->price) }}" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok <span class="text-danger">*</span></label>
                        <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" 
                               value="{{ old('stock', $product->stock) }}" required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Gambar Produk</label>
                    @if($product->getImageUrl())
                        <div class="mb-2">
                            <img src="{{ $product->getImageUrl() }}" alt="{{ $product->name }}" 
                                 class="img-thumbnail" style="max-height: 150px;"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <div class="alert alert-warning small" style="display: none;">
                                <i class="fas fa-exclamation-triangle me-1"></i> Gambar tidak dapat dimuat
                            </div>
                            <p class="text-muted small mt-1">Gambar saat ini</p>
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG, GIF (Max: 2MB). Kosongkan jika tidak ingin mengubah gambar.</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="btn-group" role="group">
                    <button type="submit" 
                            class="btn btn-gradient" 
                            data-bs-toggle="tooltip" 
                            title="Simpan Perubahan">
                        <i class="fas fa-save me-2"></i> Update
                    </button>
                    <a href="{{ route('products.index') }}" 
                       class="btn btn-secondary" 
                       data-bs-toggle="tooltip" 
                       title="Batal dan Kembali">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

