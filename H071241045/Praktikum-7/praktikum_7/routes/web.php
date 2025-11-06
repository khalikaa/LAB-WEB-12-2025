<?php

use Illuminate\Support\Facades\Route;

// Halaman Home (URL: /)
Route::get('/', function () {
    return view('pages.home');
})->name('home'); // Ditambahkan penamaan rute

// Halaman Destinasi (URL: /destinasi)
Route::get('/destinasi', function () {
    return view('pages.destinasi');
})->name('destinasi'); // Ditambahkan penamaan rute

// Halaman Kuliner (URL: /kuliner)
Route::get('/kuliner', function () {
    return view('pages.kuliner');
})->name('kuliner'); // Ditambahkan penamaan rute

// Halaman Galeri (URL: /galeri)
Route::get('/galeri', function () {
    return view('pages.galeri');
})->name('galeri'); // Ditambahkan penamaan rute

// Halaman Kontak (URL: /kontak)
Route::get('/kontak', function () {
    return view('pages.kontak');
})->name('kontak'); // Ditambahkan penamaan rute