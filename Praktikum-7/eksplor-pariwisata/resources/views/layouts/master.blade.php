<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eksplor Pariwisata Nusantara - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    
    <!-- Header -->
    <header class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">Eksplor Pariwisata Nusantara</h1>
                <nav class="flex space-x-4">
                    <nav class="flex space-x-4">
    <x-nav-link href="{{ route('home') }}" :active="request()->is('/') || request()->is('home')">Home</x-nav-link>
    <x-nav-link href="{{ route('destinasi') }}" :active="request()->is('destinasi')">Destinasi</x-nav-link>
    <x-nav-link href="{{ route('kuliner') }}" :active="request()->is('kuliner')">Kuliner</x-nav-link>
    <x-nav-link href="{{ route('galeri') }}" :active="request()->is('galeri')">Galeri</x-nav-link>
    <x-nav-link href="{{ route('kontak') }}" :active="request()->is('kontak')">Kontak</x-nav-link>
                    </nav>

                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2025 Eksplor Pariwisata Nusantara. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>