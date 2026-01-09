<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::withCount('transactions')->latest()->get();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'email' => 'nullable|email|max:255',
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function show(Customer $customer)
    {
        $customer->load('transactions.transactionDetails');
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'email' => 'nullable|email|max:255',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil diupdate!');
    }

    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('customers.index')->with('error', 'Pelanggan tidak dapat dihapus karena masih memiliki transaksi!');
        }
    }
}