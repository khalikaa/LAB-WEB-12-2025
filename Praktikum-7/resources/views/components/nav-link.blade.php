@props(['active' => false])

<a {{ $attributes->class([
    'px-4 py-2 rounded-lg transition-colors duration-200',
    'bg-blue-700 text-white' => $active,
    'hover:bg-blue-500' => !$active
]) }}>
    {{ $slot }}
</a>