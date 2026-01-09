@extends('layouts.app')

@section('title', 'Transaksi Baru')
@section('page-title', 'Transaksi Baru')

@section('content')
<div class="page-header">
    <h1><i class="fas fa-shopping-cart me-2"></i> Transaksi Baru (POS)</h1>
</div>

<form action="{{ route('transactions.store') }}" method="POST" id="transactionForm">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <!-- Product Selection -->
            <div class="table-card">
                <h5 class="mb-3"><i class="fas fa-box me-2"></i> Pilih Produk</h5>
                
                <div class="row" id="productList">
                    @foreach($products as $product)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100" style="cursor: pointer;" onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, {{ $product->stock }})">
                            <div class="card-body text-center">
                                <i class="fas fa-box fa-2x text-primary mb-2"></i>
                                <h6 class="card-title">{{ $product->name }}</h6>
                                <p class="text-muted mb-1">{{ $product->category->name }}</p>
                                <p class="fw-bold text-success mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <small class="text-muted">Stok: {{ $product->stock }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Cart -->
            <div class="table-card sticky-top" style="top: 20px;">
                <h5 class="mb-3"><i class="fas fa-shopping-cart me-2"></i> Keranjang</h5>
                
                <div class="mb-3">
                    <label class="form-label">Pelanggan <span class="text-danger">*</span></label>
                    <select name="customer_id" class="form-select" required>
                        <option value="">Pilih Pelanggan</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->phone }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                    <select name="payment_method" class="form-select" required>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                        <option value="card">Card</option>
                    </select>
                </div>
                
                <hr>
                
                <div id="cartItems" class="mb-3">
                    <p class="text-muted text-center py-3">Keranjang kosong</p>
                </div>
                
                <hr>
                
                <div class="mb-2">
                    <label class="form-label">Diskon (Rp)</label>
                    <input type="number" name="discount" id="discount" class="form-control" value="0" min="0" onchange="calculateTotal()">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Pajak (Rp)</label>
                    <input type="number" name="tax" id="tax" class="form-control" value="0" min="0" onchange="calculateTotal()">
                </div>
                
                <div class="alert alert-info">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Subtotal:</span>
                        <strong id="subtotalDisplay">Rp 0</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span>Diskon:</span>
                        <strong id="discountDisplay">Rp 0</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span>Pajak:</span>
                        <strong id="taxDisplay">Rp 0</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>TOTAL:</strong>
                        <strong class="text-primary fs-5" id="totalDisplay">Rp 0</strong>
                    </div>
                </div>
                
                <button type="submit" 
                        class="btn btn-gradient w-100 mb-2" 
                        data-bs-toggle="tooltip" 
                        title="Proses dan Simpan Transaksi">
                    <i class="fas fa-check-circle me-2"></i> Proses Transaksi
                </button>
                
                <a href="{{ route('transactions.index') }}" 
                   class="btn btn-secondary w-100" 
                   data-bs-toggle="tooltip" 
                   title="Batal dan Kembali">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
let cart = [];

function addToCart(id, name, price, stock) {
    const existingItem = cart.find(item => item.id === id);
    
    if (existingItem) {
        if (existingItem.quantity < stock) {
            existingItem.quantity++;
        } else {
            alert('Stok tidak mencukupi!');
            return;
        }
    } else {
        cart.push({
            id: id,
            name: name,
            price: price,
            quantity: 1,
            stock: stock
        });
    }
    
    renderCart();
    calculateTotal();
}

function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id);
    renderCart();
    calculateTotal();
}

function updateQuantity(id, newQuantity) {
    const item = cart.find(item => item.id === id);
    if (item) {
        if (newQuantity > item.stock) {
            alert('Stok tidak mencukupi!');
            return;
        }
        if (newQuantity <= 0) {
            removeFromCart(id);
        } else {
            item.quantity = newQuantity;
        }
    }
    renderCart();
    calculateTotal();
}

function renderCart() {
    const cartItemsDiv = document.getElementById('cartItems');
    
    if (cart.length === 0) {
        cartItemsDiv.innerHTML = '<p class="text-muted text-center py-3">Keranjang kosong</p>';
        return;
    }
    
    let html = '';
    cart.forEach(item => {
        html += `
            <div class="card mb-2">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <small><strong>${item.name}</strong></small>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeFromCart(${item.id})">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <small>Rp ${item.price.toLocaleString('id-ID')}</small>
                        <div class="input-group input-group-sm" style="width: 100px;">
                            <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity(${item.id}, ${item.quantity - 1})">-</button>
                            <input type="text" class="form-control text-center" value="${item.quantity}" readonly>
                            <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity(${item.id}, ${item.quantity + 1})">+</button>
                        </div>
                    </div>
                    <input type="hidden" name="items[${item.id}][product_id]" value="${item.id}">
                    <input type="hidden" name="items[${item.id}][quantity]" value="${item.quantity}">
                </div>
            </div>
        `;
    });
    
    cartItemsDiv.innerHTML = html;
}

function calculateTotal() {
    let subtotal = 0;
    cart.forEach(item => {
        subtotal += item.price * item.quantity;
    });
    
    const discount = parseFloat(document.getElementById('discount').value) || 0;
    const tax = parseFloat(document.getElementById('tax').value) || 0;
    const total = subtotal - discount + tax;
    
    document.getElementById('subtotalDisplay').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    document.getElementById('discountDisplay').textContent = 'Rp ' + discount.toLocaleString('id-ID');
    document.getElementById('taxDisplay').textContent = 'Rp ' + tax.toLocaleString('id-ID');
    document.getElementById('totalDisplay').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

document.getElementById('transactionForm').addEventListener('submit', function(e) {
    if (cart.length === 0) {
        e.preventDefault();
        alert('Keranjang masih kosong!');
    }
});
</script>
@endpush
@endsection