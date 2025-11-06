@extends('layouts.master')

@section('title', 'Galeri Foto')

@section('content')
    <h2 class="text-3xl font-extrabold text-amber-700 mb-6 border-b pb-3">Galeri Foto Soppeng</h2>
    <p class="mb-8 text-lg text-gray-600">Bingkai keindahan alam, landmark, dan budaya dari Bumi Latemmamala.</p>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <img src="{{ asset('images/galeri-1.jpg') }}" alt="Lejja" class="w-full h-48 object-cover rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:scale-105">
        <img src="{{ asset('images/galeri-2.jpg') }}" alt="Landmark" class="w-full h-48 object-cover rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:scale-105">
        <img src="{{ asset('images/galeri-3.jpg') }}" alt="Budaya" class="w-full h-48 object-cover rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:scale-105">
        <img src="{{ asset('images/galeri-4.jpg') }}" alt="Pemandangan" class="w-full h-48 object-cover rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:scale-105">
        <img src="{{ asset('images/galeri-5.jpg') }}" alt="Pasar" class="w-full h-48 object-cover rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:scale-105">
        <img src="{{ asset('images/galeri-6.jpg') }}" alt="Sawah" class="w-full h-48 object-cover rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:scale-105">
    </div>
@endsection