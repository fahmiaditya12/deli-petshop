<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Deli Petshop')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h3><i class="fas fa-paw"></i> DELI PETSHOP</h3>
                <small>Management System</small>
            </div>
            
            <nav class="sidebar-menu">
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('categories.index') }}" class="menu-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <i class="fas fa-folder"></i>
                    <span>Kategori Produk</span>
                </a>
                
                <a href="{{ route('products.index') }}" class="menu-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i>
                    <span>Produk</span>
                </a>
                
                <a href="{{ route('customers.index') }}" class="menu-item {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Pelanggan</span>
                </a>
                
                <a href="{{ route('transactions.index') }}" class="menu-item {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Transaksi</span>
                </a>
                
                @if(auth()->user()->isAdmin())
                <a href="{{ route('users.index') }}" class="menu-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="fas fa-user-shield"></i>
                    <span>Manajemen User</span>
                </a>
                @endif
                
                <hr class="my-3">
                
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Navbar -->
            <nav class="navbar">
                <div>
                    <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
                </div>
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="badge bg-primary">{{ auth()->user()->role }}</span>
                    </div>
                    <div>
                        <i class="fas fa-user-circle me-2"></i>
                        <strong>{{ auth()->user()->name }}</strong>
                    </div>
                </div>
            </nav>
            
            <!-- Content -->
            <div class="content-wrapper">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </main>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (Optional) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <!-- Initialize Bootstrap Tooltips -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>