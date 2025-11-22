@extends('layouts.master')

@section('title', 'Galeri Foto')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h2 class="text-4xl font-extrabold text-gray-900 mb-8 border-b-4 border-red-700 pb-3">Galeri Pesona Yogyakarta</h2>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="overflow-hidden rounded-lg shadow-lg">
            <img src="{{ asset('images/tugu.jpg') }}" alt="Tugu Pal Putih" class="w-full h-full object-cover transform hover:scale-105 transition duration-500">
        </div>
        <div class="overflow-hidden rounded-lg shadow-lg">
            <img src="{{ asset('images/keraton.jpg') }}" alt="Keraton Jogja" class="w-full h-full object-cover transform hover:scale-105 transition duration-500">
        </div>
        <div class="overflow-hidden rounded-lg shadow-lg">
            <img src="{{ asset('images/batik.jpg') }}" alt="Batik Tulis" class="w-full h-full object-cover transform hover:scale-105 transition duration-500">
        </div>
        <div class="overflow-hidden rounded-lg shadow-lg">
            <img src="{{ asset('images/merapi.jpg') }}" alt="Gunung Merapi" class="w-full h-full object-cover transform hover:scale-105 transition duration-500">
        </div>
        <div class="overflow-hidden rounded-lg shadow-lg">
            <img src="{{ asset('images/tamansari.jpg') }}" alt="Taman Sari" class="w-full h-full object-cover transform hover:scale-105 transition duration-500">
        </div>
        <div class="overflow-hidden rounded-lg shadow-lg">
            <img src="{{ asset('images/senja.jpg') }}" alt="Senja di Pantai" class="w-full h-full object-cover transform hover:scale-105 transition duration-500">
        </div>
        <div class="overflow-hidden rounded-lg shadow-lg">
            <img src="{{ asset('images/andong.jpg') }}" alt="Andong Malioboro" class="w-full h-full object-cover transform hover:scale-105 transition duration-500">
        </div>
        <div class="overflow-hidden rounded-lg shadow-lg">
            <img src="{{ asset('images/angklung.jpg') }}" alt="Pertunjukan Angklung" class="w-full h-full object-cover transform hover:scale-105 transition duration-500">
        </div>
    </div>
</div>
@endsection