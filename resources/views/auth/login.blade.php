<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Deli Petshop</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-left">
                <div>
                    <i class="fas fa-paw fa-4x mb-4"></i>
                    <h1>Deli Petshop</h1>
                    <p class="mb-4">Sistem Informasi Manajemen Deli Petshop - Kelola toko hewan peliharaan Anda dengan mudah dan efisien</p>
                    <div class="mt-5">
                        <p class="mb-2"><i class="fas fa-check-circle me-2"></i> Manajemen Produk</p>
                        <p class="mb-2"><i class="fas fa-check-circle me-2"></i> Transaksi POS</p>
                        <p class="mb-2"><i class="fas fa-check-circle me-2"></i> Laporan Real-time</p>
                    </div>
                </div>
            </div>
            
            <div class="login-right">
                <div>
                    <h2><i class="fas fa-sign-in-alt me-2"></i> Login</h2>
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" 
                                       name="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       placeholder="Masukkan email"
                                       value="{{ old('email') }}"
                                       required 
                                       autofocus>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" 
                                       name="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="Masukkan password"
                                       required>
                            </div>
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Ingat Saya
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-login w-100">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </button>
                    </form>
                    
                    <div class="mt-4 text-center">
                        <small class="text-muted">
                            <strong>Demo Akun:</strong><br>
                            Admin: admin@petshop.com / admin123<br>
                            Kasir: kasir@petshop.com / kasir123
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>