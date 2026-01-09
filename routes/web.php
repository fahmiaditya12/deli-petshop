<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

// Auth Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::resource('categories', CategoryController::class);

    // Products
    Route::resource('products', ProductController::class);

    // Customers
    Route::resource('customers', CustomerController::class);

    // Transactions
    Route::resource('transactions', TransactionController::class)->except(['edit', 'update']);
    Route::get('transactions/{transaction}/print', [TransactionController::class, 'print'])->name('transactions.print');

    // Users (Admin Only)
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });
});