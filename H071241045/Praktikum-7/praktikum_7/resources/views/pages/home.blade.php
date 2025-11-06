@extends('layouts.master')

@section('title', 'Beranda - Pesona Soppeng')

@section('content')
 
    <div class="relative h-screen">
 
        <div class="absolute inset-0">
            <img src="{{ asset('images/background-soppeng.jpg') }}" 
                 alt="Pemandangan Soppeng" 
                 class="w-full h-full object-cover">
          
            <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/30 to-black/60"></div>
        </div>

        <div class="relative z-10 flex items-center justify-center h-full">
            <div class="container mx-auto px-4 text-center text-white"> 
                <h1 class="text-5xl md:text-6xl font-extrabold mb-6 drop-shadow-2xl animate-fade-in">
                    Selamat Datang di Soppeng, Bumi Latemmamala!
                </h1>
                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto drop-shadow-lg">
                    Eksplorasi Keindahan Alam dan Kuliner Khas Bugis di Sulawesi Selatan.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center"> 
                    <a href="{{ route('destinasi') }}" 
                        class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-3 px-8 rounded-lg transition-all transform hover:scale-105 shadow-xl">
                        ✈️ Jelajahi Destinasi
                    </a>
                    <a href="{{ route('kuliner') }}" 
                        class="bg-white hover:bg-gray-100 text-amber-700 font-bold py-3 px-8 rounded-lg transition-all transform hover:scale-105 shadow-xl border border-amber-700"> 
                        🍽️ Cicipi Kuliner
                    </a>
                </div>
            </div>
        </div>

      
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"> 
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>

    <section class="py-16 bg-amber-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-2xl p-8 md:p-12"> 
                <h2 class="text-3xl font-bold text-amber-700 mb-6 text-center">Pengenalan Singkat</h2>
                <p class="text-gray-700 text-lg leading-relaxed mb-4">
                    Kabupaten **Soppeng**, yang dikenal sebagai <span class="font-semibold italic">Bumi Latemmamala</span>, 
                    adalah salah satu daerah di Sulawesi Selatan yang menawarkan pesona wisata alam yang asri dan kaya 
                    akan budaya Bugis. Soppeng terkenal dengan permandian air panas alami <span class="font-semibold">Lejja</span>, 
                    sebuah destinasi yang menawarkan relaksasi di tengah hutan yang rimbun.
                </p>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Selain itu, Soppeng juga menyajikan kekayaan kuliner yang tak tertandingi, seperti 
                    <span class="font-semibold italic">Nasu Likku</span>, <span class="font-semibold italic">Onde-Onde Bugis</span>, 
                    dan <span class="font-semibold italic">Lawara</span>, yang akan memanjakan lidah Anda dengan cita rasa khas Bugis.
                </p>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-extrabold text-amber-700 mb-12 text-center">
                Mengapa Harus Berkunjung ke Soppeng?
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
             
                <div class="bg-gradient-to-br from-amber-50 to-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-shadow duration-300"> 
                    <div class="text-amber-600 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-amber-700 mb-4 text-center">Keindahan Alam 🏞️</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Dari permandian air panas alami hingga puncak pegunungan yang mempesona, Soppeng menawarkan 
                        berbagai destinasi alam yang memukau dan menenangkan.
                    </p>
                </div>

                <div class="bg-gradient-to-br from-amber-50 to-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-shadow duration-300">
                    <div class="text-amber-600 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-amber-700 mb-4 text-center">Kuliner Otentik 🍜</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Nikmati kelezatan kuliner khas Bugis yang kaya rempah dan cita rasa tradisional yang autentik. 
                        Setiap hidangan punya cerita tersendiri.
                    </p>
                </div>

                <div class="bg-gradient-to-br from-amber-50 to-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-shadow duration-300">
                    <div class="text-amber-600 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-amber-700 mb-4 text-center">Budaya & Tradisi 🎭</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Rasakan kehangatan masyarakat Bugis dengan budaya dan tradisi yang masih terjaga dengan baik 
                        hingga saat ini.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section class="py-16 bg-gradient-to-r from-amber-600 to-amber-700 text-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center"> 
                
                <div class="transform hover:scale-105 transition-transform">
                    <div class="text-5xl font-extrabold mb-2">10+</div>
                    <div class="text-lg opacity-90">Destinasi Wisata</div>
                </div>

                <div class="transform hover:scale-105 transition-transform">
                    <div class="text-5xl font-extrabold mb-2">15+</div>
                    <div class="text-lg opacity-90">Kuliner Khas</div>
                </div>

                <div class="transform hover:scale-105 transition-transform">
                    <div class="text-5xl font-extrabold mb-2">8</div>
                    <div class="text-lg opacity-90">Kecamatan</div>
                </div>

                <div class="transform hover:scale-105 transition-transform">
                    <div class="text-5xl font-extrabold mb-2">250K+</div>
                    <div class="text-lg opacity-90">Penduduk</div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">

            <div class="mb-16">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8"> 
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-amber-700 mb-4 sm:mb-0">Destinasi Populer ✨</h2>
                    <a href="{{ route('destinasi') }}" 
                        class="text-amber-600 hover:text-amber-700 font-semibold flex items-center gap-2">
                        Lihat Semua 
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <x-info-card 
                        title="Permandian Air Panas Lejja" 
                        image-path="images/lejja.jpg" 
                        description="Ikon pariwisata Kabupaten Soppeng dengan air panas alami berkhasiat terapeutik." 
                    />
                    <x-info-card 
                        title="Goa Cabbie" 
                        image-path="images/goa.jpg" 
                        description="Petualangan goa dengan stalaktit dan stalagmit yang memukau." 
                    />
                    <x-info-card 
                        title="Wisata Alam Bulu Dua" 
                        image-path="images/buludua.jpg" 
                        description="Puncak dengan pemandangan kabupaten dari ketinggian." 
                    />
                </div>
            </div>

            <div>
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8"> 
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-amber-700 mb-4 sm:mb-0">Kuliner Khas 🌶️</h2>
                    <a href="{{ route('kuliner') }}" 
                        class="text-amber-600 hover:text-amber-700 font-semibold flex items-center gap-2">
                        Lihat Semua 
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <x-info-card 
                        title="Nasu Likku" 
                        image-path="images/nasulekku.jpg" 
                        description="Ayam kampung dengan parutan lengkuas dan rempah khas Bugis." 
                    />
                    <x-info-card 
                        title="Onde-Onde Bugis" 
                        image-path="images/ondeonde.jpg" 
                        description="Ketan kenyal berisi gula merah dibaluri kelapa parut." 
                    />
                    <x-info-card 
                        title="Lawara" 
                        image-path="images/lawara.jpg" 
                        description="Daging cincang dengan kelapa sangrai dan bumbu segar." 
                    />
                </div>
            </div>

        </div>
    </section>

    <section class="py-20 bg-gradient-to-br from-amber-100 to-amber-50">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-extrabold text-amber-700 mb-6">
                Siap Menjelajahi Soppeng?
            </h2>
            <p class="text-xl text-gray-700 mb-8 max-w-2xl mx-auto">
                Rencanakan perjalanan Anda sekarang dan temukan pesona Bumi Latemmamala yang memukau!
            </p>
        </div>
    </section>

@endsection

@push('styles')
 
<style>

    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in {
        animation: fade-in 1s ease-out;
    }
   
</style>
@endpush