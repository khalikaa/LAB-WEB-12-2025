@props(['title', 'image', 'description'])

<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    @if($image)
    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-48 object-cover">
    @endif
    <div class="p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $title }}</h3>
        <p class="text-gray-600">{{ $description }}</p>
    </div>
</div>