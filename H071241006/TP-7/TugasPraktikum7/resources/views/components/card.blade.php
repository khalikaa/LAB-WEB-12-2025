@props(['title', 'image'])
<div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200"> 
    @if(isset($image)) 
    <img src="{{ asset('images/' . $image) }}" alt="{{ $title }}" class="w-full h-48 object-cover">
    @endif
    <div class="p-6"> 
        <h3 class="text-2xl font-semibold text-gray-900 mb-2">{{ $title }}</h3>
        <p class="text-gray-600">
            {{ $slot }} 
        </p> 
    </div> 
</div> 