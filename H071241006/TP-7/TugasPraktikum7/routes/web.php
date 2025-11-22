<?php

use Illuminate\Support\Facades\Route;

// 1. Rute Home (http://localhost/)
Route::get('/', function () {
    return view('pages.home');
});

// 2. Rute Destinasi (http://localhost/destinasi)
Route::get('/destinasi', function () {
    return view('pages.destinasi');
});

// 3. Rute Kuliner (http://localhost/kuliner)
Route::get('/kuliner', function () {
    return view('pages.kuliner');
});

// 4. Rute Galeri (http://localhost/galeri)
Route::get('/galeri', function () {
    return view('pages.galeri');
});

// 5. Rute Kontak (http://localhost/kontak)
Route::get('/kontak', function () {
    return view('pages.kontak');
});
