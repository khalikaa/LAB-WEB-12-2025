<div class="bg-white rounded-lg shadow-xl overflow-hidden transform hover:scale-[1.02] transition duration-300 border border-amber-100">
    <img src="{{ asset($imagePath) }}" alt="{{ $title }}" class="w-full h-48 object-cover object-center">
    
    <div class="p-6 text-center"> 
        <h3 class="text-xl font-bold text-amber-800 mb-3 border-b-2 border-amber-500 pb-2 inline-block"> 
            {{ $title }}
        </h3>
        <p class="text-gray-700 leading-relaxed">{{ $description }}</p>
    </div>
</div>