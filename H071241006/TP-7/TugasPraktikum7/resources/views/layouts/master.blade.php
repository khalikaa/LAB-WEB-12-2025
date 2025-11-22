<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eksplor Yogyakarta | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> 
</head>
<body class="bg-gray-50">

    <header class="bg-red-700 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white">Jogja Istimewa</h1>
            <nav class="flex space-x-4">
                {{-- Menggunakan komponen nav-link yang sudah Anda definisikan --}}
                <x-nav-link link="/">Home</x-nav-link>
                <x-nav-link link="/destinasi">Destinasi</x-nav-link>
                <x-nav-link link="/kuliner">Kuliner</x-nav-link>
                <x-nav-link link="/galeri">Galeri</x-nav-link>
                <x-nav-link link="/kontak">Kontak</x-nav-link>
            </nav>
        </div>
    </header>

    <main class="min-h-screen">
        @yield('content')
    </main>


</body>
</html>