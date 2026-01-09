@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')

@section('content')
<div class="page-header">
    <h1><i class="fas fa-folder-plus me-2"></i> Tambah Kategori</h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="table-card">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="btn-group" role="group">
                    <button type="submit" 
                            class="btn btn-gradient" 
                            data-bs-toggle="tooltip" 
                            title="Simpan Kategori">
                        <i class="fas fa-save me-2"></i> Simpan
                    </button>
                    <a href="{{ route('categories.index') }}" 
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