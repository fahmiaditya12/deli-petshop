@extends('layouts.app')

@section('title', 'Detail Pelanggan')
@section('page-title', 'Detail Pelanggan')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-user me-2"></i> Detail Pelanggan</h1>
        <div class="btn-group" role="group">
            <a href="{{ route('customers.edit', $customer) }}"
               class="btn btn-warning"
               data-bs-toggle="tooltip"
               title="Edit Pelanggan">
                <i class="fas fa-edit me-2"></i> Edit
            </a>
            <a href="{{ route('customers.index') }}"
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
            <h5 class="mb-3">Informasi Pelanggan</h5>
            <table class="table">
                <tr>
                    <th width="35%">Nama</th>
                    <td><strong>{{ $customer->name }}</strong></td>
                </tr>
                <tr>
                    <th>Telepon</th>
                    <td>
                        @if($customer->phone)
                            <i class="fas fa-phone me-1"></i>{{ $customer->phone }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        @if($customer->email)
                            <i class="fas fa-envelope me-1"></i>{{ $customer->email }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $customer->address ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Terdaftar</th>
                    <td>{{ $customer->created_at->format('d F Y') }}</td>
                </tr>
                <tr>
                    <th>Total Transaksi</th>
                    <td>
                        <span class="badge bg-primary">
                            {{ $customer->transactions->count() }} Transaksi
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-md-8">
        <div class="table-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0"><i class="fas fa-history me-2"></i> Riwayat Transaksi</h5>
                <span class="badge bg-secondary">
                    {{ $customer->transactions->count() }} Transaksi
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Tanggal</th>
                            <th class="text-end">Total</th>
                            <th>Metode</th>
                            <th>Item</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customer->transactions as $transaction)
                            <tr>
                                <td><strong>{{ $transaction->invoice_number }}</strong></td>
                                <td>{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                                <td class="text-end">
                                    Rp {{ number_format($transaction->total, 0, ',', '.') }}
                                </td>
                                <td>
                                    @if($transaction->payment_method === 'cash')
                                        <span class="badge bg-success">Cash</span>
                                    @elseif($transaction->payment_method === 'transfer')
                                        <span class="badge bg-info">Transfer</span>
                                    @else
                                        <span class="badge bg-warning">Card</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $transaction->transactionDetails->sum('quantity') }} item
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('transactions.show', $transaction) }}"
                                           class="btn btn-sm btn-info"
                                           data-bs-toggle="tooltip"
                                           title="Detail Transaksi">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('transactions.print', $transaction) }}"
                                           target="_blank"
                                           class="btn btn-sm btn-success"
                                           data-bs-toggle="tooltip"
                                           title="Cetak Struk">
                                            <i class="fas fa-print"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="fas fa-info-circle fa-2x mb-2 d-block"></i>
                                    Belum ada transaksi untuk pelanggan ini
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

