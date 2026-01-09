<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['customer', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::where('stock', '>', 0)->get();
        return view('transactions.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'payment_method' => 'required|in:cash,transfer,card',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // Calculate totals
            $subtotal = 0;
            $discount = $request->discount ?? 0;
            $tax = $request->tax ?? 0;

            // Create transaction
            $transaction = Transaction::create([
                'customer_id' => $validated['customer_id'],
                'user_id' => Auth::id(),
                'invoice_number' => Transaction::generateInvoiceNumber(),
                'transaction_date' => now(),
                'subtotal' => 0, // Will update later
                'discount' => $discount,
                'tax' => $tax,
                'total' => 0, // Will update later
                'payment_method' => $validated['payment_method'],
            ]);

            // Create transaction details
            foreach ($validated['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                
                // Check stock
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok produk {$product->name} tidak mencukupi!");
                }

                $itemSubtotal = $product->price * $item['quantity'];
                $subtotal += $itemSubtotal;

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $itemSubtotal,
                ]);

                // Update stock
                $product->updateStock($item['quantity']);
            }

            // Update transaction totals
            $total = $subtotal - $discount + $tax;
            $transaction->update([
                'subtotal' => $subtotal,
                'total' => $total,
            ]);

            DB::commit();

            return redirect()->route('transactions.show', $transaction)
                ->with('success', 'Transaksi berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['customer', 'user', 'transactionDetails.product']);
        return view('transactions.show', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        DB::beginTransaction();
        try {
            // Restore stock
            foreach ($transaction->transactionDetails as $detail) {
                $product = Product::find($detail->product_id);
                if ($product) {
                    $product->stock += $detail->quantity;
                    $product->save();
                }
            }

            $transaction->delete();
            DB::commit();

            return redirect()->route('transactions.index')
                ->with('success', 'Transaksi berhasil dihapus dan stok dikembalikan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus transaksi: ' . $e->getMessage());
        }
    }

    public function print(Transaction $transaction)
    {
        $transaction->load(['customer', 'user', 'transactionDetails.product']);
        return view('transactions.print', compact('transaction'));
    }
}