@extends('layouts.master')

@section('title', 'Kuliner Khas')
@section('content')
<h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Kuliner Khas Yogyakarta</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <x-card 
        title="Gudeg" 
        image="/images/kuliner/gudeg.jpg"
        description="Masakan khas Yogyakarta yang terbuat dari nangka muda dimasak dengan santan. Biasanya disajikan dengan ayam, telur, dan sambal krecek.">
    </x-card>

    <x-card 
        title="Bakpia Pathok" 
        image="/images/kuliner/pia.jpg"
        description="Kue tradisional berisi kacang hijau yang menjadi oleh-oleh khas Jogja. Dinamakan Pathok dari daerah asal pembuatannya.">
    </x-card>

    <x-card 
        title="Angkringan" 
        image="/images/kuliner/angkringan.jpg"
        description="Warung tenda khas Jogja yang menjual berbagai makanan dan minuman dengan harga terjangkau. Tempat nongkrong favorit warga.">
    </x-card>

    <x-card 
        title="Sate Klathak" 
        image="/images/kuliner/sate.jpg"
        description="Sate khas dari Bantul yang menggunakan tusukan dari besi dan daging kambing yang dibakar dengan bumbu spesial.">
    </x-card>

    <x-card 
        title="Wedang Uwuh" 
       image="/images/kuliner/wedang uwuh.jpg"
        description="Minuman herbal tradisional yang terbuat dari rempah-rempah. Dinamakan 'uwuh' karena penampilannya yang seperti sampah.">
    </x-card>

    <x-card 
        title="Geplak" 
        image="/images/kuliner/geplak.jpg"
        description="Makanan ringan tradisional yang terbuat dari kelapa dan gula. Memiliki tekstur yang kenyal dan rasa manis yang khas.">
    </x-card>
</div>
@endsection