@extends('layouts.app')

@section('title', 'Dashboard - Deli Petshop')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-header">
    <h1><i class="fas fa-chart-line me-2"></i> Dashboard</h1>
    <p class="text-muted">Ringkasan dan statistik sistem</p>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card primary">
            <i class="fas fa-box fa-2x text-primary mb-3"></i>
            <h3>{{ $totalProducts }}</h3>
            <p>Total Produk</p>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card success">
            <i class="fas fa-folder fa-2x text-success mb-3"></i>
            <h3>{{ $totalCategories }}</h3>
            <p>Total Kategori</p>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card warning">
            <i class="fas fa-users fa-2x text-warning mb-3"></i>
            <h3>{{ $totalCustomers }}</h3>
            <p>Total Pelanggan</p>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card danger">
            <i class="fas fa-shopping-cart fa-2x text-danger mb-3"></i>
            <h3>{{ $totalTransactions }}</h3>
            <p>Total Transaksi</p>
        </div>
    </div>
</div>

<!-- Revenue Card -->
<div class="row g-4 mb-4">
    <div class="col-md-12">
        <div class="table-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-2"><i class="fas fa-dollar-sign me-2"></i> Total Pendapatan</h5>
                    <h2 class="mb-0">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
                </div>
                <div>
                    <i class="fas fa-chart-line fa-4x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Low Stock Products -->
    @if($lowStockProducts->count() > 0)
    <div class="col-md-6">
        <div class="table-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0"><i class="fas fa-exclamation-triangle text-warning me-2"></i> Stok Menipis</h5>
                <span class="badge bg-warning">{{ $lowStockProducts->count() }} Produk</span>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lowStockProducts as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td><span class="badge bg-secondary">{{ $product->category->name }}</span></td>
                            <td>
                                <span class="low-stock-badge">
                                    <i class="fas fa-box me-1"></i> {{ $product->stock }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Recent Transactions -->
    <div class="col-md-6">
        <div class="table-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0"><i class="fas fa-history me-2"></i> Transaksi Terbaru</h5>
                <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-gradient">
                    Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTransactions as $transaction)
                        <tr>
                            <td>
                                <a href="{{ route('transactions.show', $transaction) }}" class="text-decoration-none">
                                    <strong>{{ $transaction->invoice_number }}</strong>
                                </a>
                            </td>
                            <td>{{ $transaction->customer->name }}</td>
                            <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle me-1"></i> Selesai
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada transaksi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Top Products -->
    @if($topProducts->count() > 0)
    <div class="col-md-6">
        <div class="table-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0"><i class="fas fa-fire text-danger me-2"></i> Produk Terlaris</h5>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topProducts as $index => $product)
                        <tr>
                            <td><strong>{{ $index + 1 }}</strong></td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <span class="badge bg-primary">
                                    <i class="fas fa-shopping-cart me-1"></i> {{ $product->total_sold }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Quick Actions -->
<div class="row g-4 mt-3">
    <div class="col-md-12">
        <div class="table-card">
            <h5 class="mb-3"><i class="fas fa-bolt me-2"></i> Quick Actions</h5>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('transactions.create') }}" class="btn btn-gradient">
                    <i class="fas fa-plus-circle me-2"></i> Transaksi Baru
                </a>
                <a href="{{ route('products.create') }}" class="btn btn-success">
                    <i class="fas fa-box me-2"></i> Tambah Produk
                </a>
                <a href="{{ route('customers.create') }}" class="btn btn-info">
                    <i class="fas fa-user-plus me-2"></i> Tambah Pelanggan
                </a>
                <a href="{{ route('categories.create') }}" class="btn btn-warning">
                    <i class="fas fa-folder-plus me-2"></i> Tambah Kategori
                </a>
            </div>
        </div>
    </div>
</div>
@endsection