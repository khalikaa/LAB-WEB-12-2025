@extends('layouts.master')

@section('title', 'Home - Eksplor Yogyakarta')

@section('content')
<!-- Hero Section dengan Gradient Overlay -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/home/home.jpg') }}" 
             alt="Yogyakarta Landscape" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-purple-900/50"></div>
    </div>
    
    <div class="relative z-10 text-center text-white px-4 max-w-6xl mx-auto">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
            Discover The Soul of 
            <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">
                Java
            </span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 text-gray-200 max-w-3xl mx-auto leading-relaxed">
            Experience the perfect blend of ancient traditions and modern vibes in Yogyakarta, 
            where every corner tells a story.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="/destinasi" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                Explore Destinations
            </a>
            <a href="/galeri" class="border-2 border-white text-white hover:bg-white hover:text-gray-900 px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300">
                View Gallery
            </a>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10">
        <div class="animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="group">
                <div class="text-3xl md:text-4xl font-bold text-gray-800 mb-2 group-hover:text-orange-500 transition-colors">50+</div>
                <div class="text-gray-600 font-medium">Destinasi Wisata</div>
            </div>
            <div class="group">
                <div class="text-3xl md:text-4xl font-bold text-gray-800 mb-2 group-hover:text-green-500 transition-colors">100+</div>
                <div class="text-gray-600 font-medium">Kuliner Khas</div>
            </div>
            <div class="group">
                <div class="text-3xl md:text-4xl font-bold text-gray-800 mb-2 group-hover:text-blue-500 transition-colors">15+</div>
                <div class="text-gray-600 font-medium">Festival Tahunan</div>
            </div>
            <div class="group">
                <div class="text-3xl md:text-4xl font-bold text-gray-800 mb-2 group-hover:text-purple-500 transition-colors">500+</div>
                <div class="text-gray-600 font-medium">Tahun Sejarah</div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                Why <span class="text-orange-500">Yogyakarta?</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Discover what makes this cultural heart of Java truly special
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Culture Card -->
            <div class="group relative bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('images/home/budaya.jpg') }}" 
                         alt="Javanese Culture" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <div class="bg-white/20 backdrop-blur-sm rounded-full p-3 inline-block">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Rich Culture</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Immerse yourself in centuries-old Javanese traditions, royal heritage, 
                        and artistic expressions that define the soul of Yogyakarta.
                    </p>
                    <a href="#" class="inline-flex items-center text-orange-500 font-semibold group-hover:text-orange-600 transition-colors">
                        Explore Culture
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Nature Card -->
            <div class="group relative bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('images/destinasi/parangtritis.jpg') }}" 
                         alt="Natural Beauty" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <div class="bg-white/20 backdrop-blur-sm rounded-full p-3 inline-block">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Stunning Nature</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        From active volcanoes to pristine beaches, discover breathtaking landscapes 
                        that will leave you in awe of nature's beauty.
                    </p>
                    <a href="#" class="inline-flex items-center text-green-500 font-semibold group-hover:text-green-600 transition-colors">
                        Explore Nature
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Food Card -->
            <div class="group relative bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('images/home/kulinerkhas.jpg') }}" 
                         alt="Local Cuisine" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <div class="bg-white/20 backdrop-blur-sm rounded-full p-3 inline-block">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0A2.704 2.704 0 013 15.546M21 12V9a2 2 0 00-2-2h-2.5M3 12V9a2 2 0 012-2h2.5m0 0V5a2 2 0 012-2h2a2 2 0 012 2v2M7.5 7h9"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Authentic Cuisine</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Savor the flavors of traditional Javanese cuisine, from street food delights 
                        to royal recipes passed down through generations.
                    </p>
                    <a href="#" class="inline-flex items-center text-red-500 font-semibold group-hover:text-red-600 transition-colors">
                        Explore Food
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-purple-600 to-orange-500">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
            Ready to Explore Yogyakarta?
        </h2>
        <p class="text-xl text-purple-100 mb-8 max-w-2xl mx-auto">
            Start your journey today and create unforgettable memories in the heart of Java
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/destinasi" class="bg-white text-purple-600 hover:bg-gray-100 px-8 py-4 rounded-full font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                Plan Your Trip
            </a>
            <a href="/kontak" class="border-2 border-white text-white hover:bg-white hover:text-purple-600 px-8 py-4 rounded-full font-bold text-lg transition-all duration-300">
                Get in Touch
            </a>
        </div>
    </div>
</section>
@endsection