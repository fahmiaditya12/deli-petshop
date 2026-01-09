@extends('layouts.app')

@section('title', 'Detail Transaksi')
@section('page-title', 'Detail Transaksi')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-file-invoice-dollar me-2"></i>
            Detail Transaksi
        </h1>
        <div class="btn-group" role="group">
            <a href="{{ route('transactions.print', $transaction) }}"
               target="_blank"
               class="btn btn-success"
               data-bs-toggle="tooltip"
               title="Cetak Struk">
                <i class="fas fa-print me-2"></i> Cetak
            </a>
            <a href="{{ route('transactions.index') }}"
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
            <h5 class="mb-3"><i class="fas fa-receipt me-2"></i> Informasi Transaksi</h5>
            <table class="table">
                <tr>
                    <th width="40%">Invoice</th>
                    <td><strong>{{ $transaction->invoice_number }}</strong></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{ $transaction->transaction_date->format('d F Y') }}</td>
                </tr>
                <tr>
                    <th>Pelanggan</th>
                    <td>
                        <strong>{{ $transaction->customer->name }}</strong><br>
                        <small class="text-muted">
                            <i class="fas fa-phone me-1"></i>{{ $transaction->customer->phone }}
                        </small>
                    </td>
                </tr>
                <tr>
                    <th>Kasir</th>
                    <td>{{ $transaction->user->name }}</td>
                </tr>
                <tr>
                    <th>Metode Bayar</th>
                    <td>
                        @if($transaction->payment_method === 'cash')
                            <span class="badge bg-success">Cash</span>
                        @elseif($transaction->payment_method === 'transfer')
                            <span class="badge bg-info">Transfer</span>
                        @else
                            <span class="badge bg-warning">Card</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <div class="table-card mt-3">
            <h5 class="mb-3"><i class="fas fa-calculator me-2"></i> Ringkasan Pembayaran</h5>
            <table class="table">
                <tr>
                    <th>Subtotal</th>
                    <td class="text-end">
                        Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <th>Diskon</th>
                    <td class="text-end">
                        Rp {{ number_format($transaction->discount, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <th>Pajak</th>
                    <td class="text-end">
                        Rp {{ number_format($transaction->tax, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td class="text-end">
                        <h4 class="text-primary mb-0">
                            Rp {{ number_format($transaction->total, 0, ',', '.') }}
                        </h4>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-md-8">
        <div class="table-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i> Item Transaksi</h5>
                <span class="badge bg-primary">
                    {{ $transaction->transactionDetails->count() }} Item
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Harga</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->transactionDetails as $index => $detail)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $detail->product->name }}</strong><br>
                                    <small class="text-muted">
                                        Kode: {{ $detail->product->id }}
                                    </small>
                                </td>
                                <td class="text-center">{{ $detail->quantity }}</td>
                                <td class="text-end">
                                    Rp {{ number_format($detail->price, 0, ',', '.') }}
                                </td>
                                <td class="text-end">
                                    Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

