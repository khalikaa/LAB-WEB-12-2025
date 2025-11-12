@extends('layouts.master')

@section('title', 'Destinasi Wisata')

@section('content')
<h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Destinasi Wisata Yogyakarta</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <x-card 
        title="Candi Borobudur" 
        image="/images/destinasi/indonesia.jpg"
        description="Candi Buddha terbesar di dunia yang dibangun pada abad ke-9. Merupakan warisan dunia UNESCO dengan arsitektur yang menakjubkan.">
    </x-card>

    <x-card 
        title="Keraton Yogyakarta" 
        image="/images/destinasi/keraton.jpg"
        description="Istana resmi Kesultanan Yogyakarta yang masih berfungsi hingga kini. Menyimpan berbagai koleksi budaya dan sejarah Jawa.">
    </x-card>

    <x-card 
        title="Malioboro" 
        image="/images/destinasi/malioboro.jpg"
        description="Jalan shopping legendaris di Yogyakarta yang terkenal dengan pedagang kaki lima dan kerajinan khas Jogja.">
    </x-card>

    <x-card 
        title="Pantai Parangtritis" 
        image="/images/destinasi/parangtritis.jpg"
        description="Pantai yang terkenal dengan pemandangan sunset yang indah dan legenda Nyi Roro Kidul yang melekat.">
    </x-card>

    <x-card 
        title="Taman Sari" 
        image="/images/destinasi/taman sari.jpg"
        description="Kompleks bekas taman kerajaan yang memiliki arsitektur unik dengan kolam pemandian dan lorong bawah tanah.">
    </x-card>

    <x-card 
        title="Gunung Merapi" 
        image="/images/destinasi/merapi.jpg"
        description="Gunung berapi aktif dengan landscape yang menakjubkan. Menawarkan wisata jeep dan museum merapi.">
    </x-card>
</div>
@endsection