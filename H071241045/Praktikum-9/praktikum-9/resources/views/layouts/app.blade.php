<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistem Manajemen Produk' }}</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
    </style>

    <!-- Custom Colors -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        pinkSoft: "#ff9acb",
                        pinkDark: "#ff72b1",

                        greenSoft: "#8ef0c0",
                        greenDark: "#3acb8e",

                        purpleSoft: "#c8a8ff",
                        purpleDark: "#a47cff",
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen bg-gradient-to-br from-pinkSoft/30 via-purpleSoft/20 to-greenSoft/30">

    <!-- NAVBAR GLASS EFFECT -->
    <nav class="sticky top-0 bg-white/60 backdrop-blur-md border-b border-purpleSoft/40 shadow-lg z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <!-- LOGO -->
            <h1 class="text-3xl font-extrabold tracking-wide
                       bg-gradient-to-r from-pinkDark via-purpleDark to-greenDark
                       bg-clip-text text-transparent drop-shadow-lg">
                🌸 Manajemen Produk
            </h1>

            <!-- MENU -->
            <div class="hidden md:flex space-x-8 text-lg">
                <a href="/products" 
                   class="font-semibold text-gray-700 hover:text-pinkDark transition">Produk</a>

                <a href="/categories" 
                   class="font-semibold text-gray-700 hover:text-greenDark transition">Kategori</a>

                <a href="/warehouses" 
                   class="font-semibold text-gray-700 hover:text-purpleDark transition">Gudang</a>

                <a href="/stocks" 
                   class="font-semibold text-gray-700 hover:text-greenDark transition">Stok</a>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="max-w-6xl mx-auto px-6 py-8">

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
        <div class="mb-4 p-4 bg-greenSoft/80 text-gray-900 rounded-xl shadow">
            {{ session('success') }}
        </div>
        @endif

        {{-- ERRORS --}}
        @if ($errors->any())
        <div class="mb-4 p-4 bg-pinkSoft/80 text-gray-900 rounded-xl shadow">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @yield('content')
    </div>

    <!-- FOOTER -->
    <footer class="text-center py-8 text-gray-700 mt-10">
        <p class="text-sm font-semibold">
            Dibuat dengan ❤️ sepenuh cinta  
            
        </p>
    </footer>

</body>
</html>
