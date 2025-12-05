@extends('layouts.master')

@section('title', 'Beranda')

@section('content')
<div class="py-12 bg-cover bg-center" style="background-image: url('{{ asset('images/tugu-jogja-bg.jpg') }}');">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center bg-black bg-opacity-50 p-10 rounded-lg">
        <h2 class="text-5xl font-extrabold text-white mb-4">SELAMAT DATANG DI YOGYAKARTA</h2>
        <p class="text-xl text-yellow-300">Daerah Istimewa yang kaya akan budaya, sejarah, dan pesona alam.</p>
    </div>
</div>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h3 class="text-3xl font-bold text-gray-800 mb-6 border-b-2 border-red-700 pb-2">Tentang Jogja Istimewa</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
        <p class="text-gray-700 leading-relaxed text-lg">
            Yogyakarta, atau akrab disapa Jogja, adalah jantung budaya Jawa. Kota ini dikenal dengan gelar Daerah Istimewa karena sistem pemerintahannya yang unik dengan Sultan sebagai Gubernur. 
            Dari gemerlap Malioboro hingga keagungan Candi Borobudur (meski secara administratif di Magelang, ia ikon dekat Jogja) dan Prambanan, Jogja menawarkan pengalaman wisata yang lengkap. 
            Rasakan keramahan penduduknya, nikmati senja di pantai-pantai selatan, dan selami sejarah di keraton yang masih hidup.
        </p>
        <div>
            <img src="{{ asset('images/keraton-jogja.jpg') }}" alt="Keraton Yogyakarta" class="rounded-lg shadow-xl">
        </div>
    </div>
</section>
@endsection