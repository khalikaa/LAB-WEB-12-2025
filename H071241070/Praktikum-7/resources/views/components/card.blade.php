@props(['image', 'title'])

<div class="card">
    <img src="{{ $image }}" alt="{{ $title }}">
    <div class="card-content">
        <h3>{{ $title }}</h3>
        <p>
            {{-- $slot adalah variabel spesial untuk menampung konten/pesan --}}
            {{ $slot }}
        </p>
    </div>
</div>