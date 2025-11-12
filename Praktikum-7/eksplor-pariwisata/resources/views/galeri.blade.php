@extends('layouts.master')

@section('title', 'Galeri Foto')
@section('content')
<h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Galeri Yogyakarta</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="overflow-hidden rounded-lg shadow-lg">
        <img src="/images/galeri/Candi.jpg" alt="Candi Prambanan" class="w-full h-64 object-cover hover:scale-105 transition-transform duration-300">
    </div>
    <div class="overflow-hidden rounded-lg shadow-lg">
        <img src="/images/galeri/alunalun.jpg" alt="Alun-alun Selatan" class="w-full h-64 object-cover hover:scale-105 transition-transform duration-300">
    </div>
    <div class="overflow-hidden rounded-lg shadow-lg">
        <img src="/images/destinasi/keraton.jpg" alt="Keraton Yogyakarta" class="w-full h-64 object-cover hover:scale-105 transition-transform duration-300">
    </div>
    <div class="overflow-hidden rounded-lg shadow-lg">
        <img src="/images/galeri/jalan.jpg" alt="Jalan Malioboro" class="w-full h-64 object-cover hover:scale-105 transition-transform duration-300">
    </div>
    <div class="overflow-hidden rounded-lg shadow-lg">
        <img src="/images/destinasi/taman sari.jpg" alt="Taman Sari" class="w-full h-64 object-cover hover:scale-105 transition-transform duration-300">
    </div>
    <div class="overflow-hidden rounded-lg shadow-lg">
        <img src="/images/destinasi/merapi.jpg" alt="Gunung Merapi" class="w-full h-64 object-cover hover:scale-105 transition-transform duration-300">
    </div>
    <div class="overflow-hidden rounded-lg shadow-lg">
        <img src="/images/galeri/baru.jpg" alt="Pantai Parangtritis" class="w-full h-64 object-cover hover:scale-105 transition-transform duration-300">
    </div>
    <div class="overflow-hidden rounded-lg shadow-lg">
        <img src="/images/galeri/benteng.jpg" alt="Benteng Vredeburg" class="w-full h-64 object-cover hover:scale-105 transition-transform duration-300">
    </div>
    <div class="overflow-hidden rounded-lg shadow-lg">
        <img src="/images/galeri/museum.jpg" alt="Museum Sonobudoyo" class="w-full h-64 object-cover hover:scale-105 transition-transform duration-300">
    </div>
</div>
@endsection