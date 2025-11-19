<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;

// Redirect ke halaman produk
Route::get('/', function () {
    return redirect()->route('products.index');
});

// CATEGORY CRUD
Route::resource('categories', CategoryController::class);

// WAREHOUSE CRUD
Route::resource('warehouses', WarehouseController::class);

// PRODUCT CRUD
Route::resource('products', ProductController::class);

// STOCK PAGE (lihat semua stok)
Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');

// FORM TRANSFER STOK
Route::get('/stocks/transfer', [StockController::class, 'create'])->name('stocks.transfer');

// PROSES TRANSFER STOK
Route::post('/stocks/transfer', [StockController::class, 'store'])->name('stocks.transfer.store');




