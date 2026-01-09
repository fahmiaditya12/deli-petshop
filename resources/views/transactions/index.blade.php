@extends('layouts.app')

@section('title', 'Daftar Transaksi')
@section('page-title', 'Daftar Transaksi')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-shopping-cart me-2"></i> Daftar Transaksi</h1>
            <p class="text-muted mb-0">Riwayat transaksi penjualan</p>
        </div>
        <a href="{{ route('transactions.create') }}" class="btn btn-gradient">
            <i class="fas fa-plus-circle me-2"></i> Transaksi Baru
        </a>
    </div>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Kasir</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $index => $transaction)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $transaction->invoice_number }}</strong></td>
                    <td>{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                    <td>{{ $transaction->customer->name }}</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td><strong class="text-success">Rp {{ number_format($transaction->total, 0, ',', '.') }}</strong></td>
                    <td>
                        @if($transaction->payment_method == 'cash')
                            <span class="badge bg-success">Cash</span>
                        @elseif($transaction->payment_method == 'transfer')
                            <span class="badge bg-info">Transfer</span>
                        @else
                            <span class="badge bg-warning">Card</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('transactions.show', $transaction) }}" 
                               class="btn btn-sm btn-info" 
                               data-bs-toggle="tooltip" 
                               title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('transactions.print', $transaction) }}" 
                               class="btn btn-sm btn-success" 
                               target="_blank"
                               data-bs-toggle="tooltip" 
                               title="Cetak Struk">
                                <i class="fas fa-print"></i>
                            </a>
                            @if(auth()->user()->isAdmin())
                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-danger" 
                                        data-bs-toggle="tooltip" 
                                        title="Hapus Transaksi"
                                        onclick="return confirm('Yakin ingin menghapus transaksi ini? Stok akan dikembalikan.')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        <i class="fas fa-shopping-cart fa-3x mb-3 d-block"></i>
                        Belum ada transaksi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection