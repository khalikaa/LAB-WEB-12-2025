@extends('layouts.master')

@section('title', 'Kuliner Khas')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-extrabold text-amber-700 mb-6 border-b pb-3">
            Kuliner Khas Kabupaten Soppeng
        </h2>
        <p class="mb-8 text-lg text-gray-600">
            Cicipi cita rasa otentik Bugis dengan kuliner khas Soppeng yang kaya rempah.
        </p>

        <x-interactive-map title="Cari Restoran & Rumah Makan" height="500px">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d254425.0287524724!2d119.72139765!3d-4.3524968!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m1!3e6!5e0!3m2!1sid!2sid!4v1730722000000!5m2!1sid!2sid"
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </x-interactive-map>

        <h3 class="text-2xl font-bold text-amber-700 mb-6 mt-12">Menu Favorit</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <x-info-card 
                title="Nasu Likku" 
                image-path="images/nasulekku.jpg" 
                description="Ayam kampung dimasak dengan parutan 'likku' (lengkuas) dan rempah khas. Rasanya gurih, aromatik, dan wajib dicoba saat berada di Soppeng." 
            />

            <x-info-card 
                title="Onde-Onde Bugis" 
                image-path="images/ondeonde.jpg" 
                description="Jajanan tradisional berupa bola-bola ketan kenyal berisi gula merah dan dibaluri kelapa parut. Ini berbeda dengan onde-onde yang digoreng." 
            />
            
            <x-info-card 
                title="Lawara" 
                image-path="images/lawara.jpg" 
                description="Hidangan lauk dari daging cincang (ikan/ayam) yang dicampur kelapa parut sangrai dan bumbu. Menyajikan rasa segar dan gurih khas Bugis." 
            />
        </div>
    </div>
@endsection