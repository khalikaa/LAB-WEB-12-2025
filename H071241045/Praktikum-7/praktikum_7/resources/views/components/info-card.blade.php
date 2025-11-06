@props(['title', 'imagePath', 'description'])

<div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
    <div class="h-48 overflow-hidden">
        <img src="{{ asset($imagePath) }}" 
             alt="{{ $title }}" 
             class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
    </div>
    <div class="p-6">
        <h3 class="text-xl font-bold text-amber-700 mb-3">{{ $title }}</h3>
        <p class="text-gray-600 leading-relaxed">{{ $description }}</p>
    </div>
</div>