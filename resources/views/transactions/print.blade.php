<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi {{ $transaction->invoice_number }}</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; }
        body { margin: 0; padding: 20px; background: #f5f5f5; }
        .receipt-wrapper { max-width: 480px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; }
        .header { text-align: center; margin-bottom: 16px; }
        .header h2 { margin: 0 0 4px; }
        .header small { color: #6b7280; }
        .info-table, .items-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .info-table td { padding: 2px 0; vertical-align: top; }
        .items-table th, .items-table td { padding: 4px 0; border-bottom: 1px dashed #d1d5db; }
        .items-table th { text-align: left; font-size: 12px; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .mt-2 { margin-top: 8px; }
        .mt-3 { margin-top: 12px; }
        .mt-4 { margin-top: 16px; }
        .total-row { font-weight: bold; }
        .footer { margin-top: 16px; text-align: center; font-size: 12px; color: #6b7280; }
        @media print {
            body { background: #fff; padding: 0; }
            .receipt-wrapper { box-shadow: none; border-radius: 0; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="receipt-wrapper">
        <div class="header">
            <h2>Deli Petshop</h2>
            <small>Sistem Informasi Manajemen</small>
        </div>

        <table class="info-table">
            <tr>
                <td>Invoice</td>
                <td>: {{ $transaction->invoice_number }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: {{ $transaction->transaction_date->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td>Pelanggan</td>
                <td>: {{ $transaction->customer->name }}</td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td>: {{ $transaction->user->name }}</td>
            </tr>
            <tr>
                <td>Metode</td>
                <td>: {{ ucfirst($transaction->payment_method) }}</td>
            </tr>
        </table>

        <div class="mt-3">
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->transactionDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->name }}</td>
                            <td class="text-center">{{ $detail->quantity }}</td>
                            <td class="text-right">
                                {{ number_format($detail->price, 0, ',', '.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($detail->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <table class="info-table">
                <tr>
                    <td>Subtotal</td>
                    <td class="text-right">
                        Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td>Diskon</td>
                    <td class="text-right">
                        Rp {{ number_format($transaction->discount, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td>Pajak</td>
                    <td class="text-right">
                        Rp {{ number_format($transaction->tax, 0, ',', '.') }}
                    </td>
                </tr>
                <tr class="total-row">
                    <td>Total</td>
                    <td class="text-right">
                        Rp {{ number_format($transaction->total, 0, ',', '.') }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="footer mt-4">
            <div>Terima kasih telah berbelanja di Deli Petshop</div>
            <div>Barang yang sudah dibeli tidak dapat dikembalikan</div>
        </div>
    </div>
</body>
</html>

