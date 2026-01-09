<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
            'totalCustomers' => Customer::count(),
            'totalTransactions' => Transaction::count(),
            'totalRevenue' => Transaction::sum('total'),
            'lowStockProducts' => Product::where('stock', '<=', 10)->get(),
            'recentTransactions' => Transaction::with(['customer', 'user'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get(),
            'topProducts' => Product::select('products.*')
                ->selectSub(
                    DB::table('transaction_details')
                        ->selectRaw('COALESCE(SUM(quantity), 0)')
                        ->whereColumn('transaction_details.product_id', 'products.id'),
                    'total_sold'
                )
                ->orderBy('total_sold', 'desc')
                ->limit(5)
                ->get(),
        ];

        return view('dashboard.index', $data);
    }
}