<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    

</head>
<body class="bg-[#FDFDFC] dark:bg-gray-900 text-gray-800 dark:text-gray-200 antialiased min-h-screen flex flex-col font-sans">

    <header class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-amber-700 dark:text-amber-500">
                        {{ config('app.name', 'WISATA LOKAL') }}
                    </a>
                </div>

                <nav class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    @php
                        $navLinks = [
                            'home'      => 'Home',
                            'destinasi' => 'Destinasi',
                            'kuliner'   => 'Kuliner',
                            'galeri'    => 'Galeri',
                            'kontak'    => 'Kontak',
                        ];
                    @endphp

                    @foreach ($navLinks as $route => $label)
                        <a href="{{ route($route) }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out
                                  @if(request()->routeIs($route))
                                      border-amber-600 text-amber-700 dark:border-amber-500 dark:text-amber-500
                                  @else
                                      border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:border-gray-600
                                  @endif">
                            {{ $label }}
                        </a>
                    @endforeach
                </nav>     

            </div>
        </div>
    </header>

    <main class="flex-grow py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @yield('content')
    </main>

    <footer class="bg-gray-100 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500 dark:text-gray-400">
            &copy; {{ date('Y') }} {{ config('app.name', 'WISATA LOKAL') }}. All rights reserved.
        </div>
    </footer>

</body>
</html>