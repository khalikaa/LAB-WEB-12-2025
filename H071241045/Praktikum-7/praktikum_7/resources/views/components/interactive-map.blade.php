@props(['title' => 'Lokasi Kami'])

<div class="bg-white rounded-xl shadow-2xl overflow-hidden mb-8 transform hover:scale-[1.01] transition-all duration-300">
    
    
    <div class="bg-amber-700 text-white p-4">
        <h3 class="text-2xl font-bold">{{ $title }}</h3>
    </div>
    
    <div class="p-4 md:p-6"> 
        
        <div class="aspect-video w-full rounded-lg overflow-hidden border border-gray-200">
            {{ $slot }} {{-- Ini akan menjadi tempat <iframe> dari Google Maps atau peta lainnya --}}
        </div>
        
        
    </div>
</div>