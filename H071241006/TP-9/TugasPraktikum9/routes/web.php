<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;

Route::get('/', function () {
    return redirect()->route('warehouses.index'); 
});

Route::resource('categories', CategoryController::class);

Route::resource('warehouses', WarehouseController::class);

Route::resource('products', ProductController::class);

Route::controller(StockController::class)->group(function () {
    Route::get('/stock', 'index')->name('stock.index');
    Route::get('/stock/transfer', 'createTransfer')->name('stock.transfer.create');
    Route::post('/stock/transfer', 'storeTransfer')->name('stock.transfer.store');
});