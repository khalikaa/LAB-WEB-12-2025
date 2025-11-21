<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Tambahkan route untuk halaman utama
Route::get('/', [PageController::class, 'home'])->name('home');

// Route lainnya
Route::get('/home', [PageController::class, 'home']);
Route::get('/destinasi', [PageController::class, 'destinasi'])->name('destinasi');
Route::get('/kuliner', [PageController::class, 'kuliner'])->name('kuliner');
Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');


// Route::get('/', function () {
//     return view('home');
// });  
// Route::get('/destinasi', function () {
//     return view('destinasi');
// });

// Route::get('/kuliner', function () {
//     return view('kuliner');
// });

// Route::get('/galeri', function () {
//     return view('galeri');
// });

// Route::get('/kontak', function () {
//     return view('kontak');
// });

