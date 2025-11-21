<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FishController; // 1. impor controller kita

use App\Http\Controllers\HomeController;

//2. Route default akan diarahkan ke halm index sesuai di tugas modul
Route::get('/' , function () {
    return redirect()-> route ("fishes.index");
});
Route::resource("fishes" , FishController::class);

// Route::get('/fishes/create', [FishController::class, 'create'])->name('fishes.create');