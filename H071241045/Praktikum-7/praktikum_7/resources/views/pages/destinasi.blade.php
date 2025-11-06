@extends('layouts.master')

@section('title', 'Destinasi Wisata')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-extrabold text-amber-700 mb-6 border-b pb-3">
            Destinasi Unggulan Soppeng
        </h2>
        <p class="mb-8 text-lg text-gray-600">
            Jelajahi keindahan alam Soppeng, dengan ikon utamanya: Permandian Air Panas Lejja.
        </p>

        <x-interactive-map title="Jelajahi Sulawesi Selatan" height="600px">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2035874.8143512197!2d118.39282484999999!3d-3.6687994999999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d94064e0823879b%3A0x5030bfbca83a200!2sSulawesi%20Selatan!5e0!3m2!1sid!2sid!4v1730722000000!5m2!1sid!2sid"
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </x-interactive-map>

        <h3 class="text-2xl font-bold text-amber-700 mb-6 mt-12">Destinasi Populer</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <x-info-card 
                title="Permandian Air Panas Lejja" 
                image-path="images/lejja.jpg" 
                description="Ikon pariwisata Kabupaten Soppeng. Air panas alami di kawasan hutan lindung ini dipercaya memiliki khasiat terapeutik. Sangat cocok untuk relaksasi." 
            />

            <x-info-card 
                title="Goa Cabbie" 
                image-path="images/goa.jpg" 
                description="Sebuah goa alam yang menawarkan petualangan speleologi di bawah tanah dengan formasi stalaktit dan stalagmit yang memukau. Dekat dari pusat kota." 
            />
            
            <x-info-card 
                title="Wisata Alam Bulu Dua" 
                image-path="images/buludua.jpg" 
                description="Kawasan puncak yang menyajikan pemandangan Kabupaten Soppeng dari ketinggian. Tempat ideal untuk menikmati kabut pagi dan berkemah." 
            />
        </div>
    </div>
@endsection