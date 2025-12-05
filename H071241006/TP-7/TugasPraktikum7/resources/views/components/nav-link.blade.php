@props(['link'])
<a href="{{ $link }}"
    class="px-4 py-2 text-white hover:bg-yellow-600 rounded-md transition duration-300 ease-in-out {{ request()->is(ltrim($link, '/')) ? 'bg-yellow-700 font-bold' : '' }}"> 
    {{ $slot }} 
</a> 