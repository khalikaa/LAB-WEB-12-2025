@props(['active' => false, 'href' => '#'])

<a href="{{ $href }}" 
   class="block px-4 py-2 rounded-lg transition-colors duration-200 
          {{ $active ? 'bg-white text-green-600 font-semibold' : 'text-white hover:bg-green-600' }}">
    {{ $slot }}
    
</a>