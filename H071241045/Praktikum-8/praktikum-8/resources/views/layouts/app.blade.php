<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fishing App')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-950 via-purple-900 to-pink-800 text-gray-100 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-gray-900/50 backdrop-blur-md border-b border-purple-700/50 shadow-lg sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('fishes.index') }}" class="text-2xl font-bold text-pink-300 hover:text-pink-100 transition">
                🐟 Fishing Manager
            </a>

            <div class="space-x-6">
                <a href="{{ route('fishes.index') }}" class="text-pink-200 hover:text-white transition">Daftar Ikan</a>
                <a href="{{ route('fishes.create') }}" 
                   class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-xl shadow-md transition">
                    Tambah Ikan
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto p-6">
    
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-700/50 border border-emerald-400 rounded-lg text-emerald-100 shadow-sm">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- Konten halaman --}}
        <div class="bg-gray-900/60 backdrop-blur-md p-6 rounded-2xl shadow-lg border border-purple-700/30">
            @yield('content')
        </div>
    </main>

    <footer class="mt-12 text-center text-pink-300/80 text-sm pb-6">
        &copy; {{ date('Y') }} <span class="font-semibold text-pink-400">Fishing Manager</span> 🎣 by Laravel ❤️
    </footer>

</body>
</html>
