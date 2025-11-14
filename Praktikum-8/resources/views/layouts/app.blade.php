<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fish It Simulator')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(180deg, #e0f2fe 0%, #f8fafc 100%);
            font-family: 'Poppins', sans-serif;
            color: #0f172a;
            min-height: 100vh;
            margin: 0;
        }

        /* --- Navbar Styling --- */
        nav.navbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            font-size: 1.3rem;
            color: #0ea5e9 !important;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .navbar-brand img {
            height: 36px;
            width: 36px;
            object-fit: contain;
            filter: drop-shadow(0 1px 2px rgba(0,0,0,0.2));
            transition: transform 0.3s;
        }

        .navbar-brand img:hover {
            transform: scale(1.1) rotate(-5deg);
        }

        /* --- Content Container --- */
        .main-container {
            padding: 40px 20px;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(14, 165, 233, 0.1);
            background-color: #ffffffd9;
        }

        /* --- Buttons --- */
        .btn-primary {
            background-color: #0ea5e9;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0284c7;
        }

        footer {
            text-align: center;
            color: #64748b;
            font-size: 0.9rem;
            margin-top: 60px;
            padding-bottom: 20px;
        }

        /* --- Table Hover --- */
        .table tbody tr:hover {
            background-color: #e0f2fe;
            transition: 0.2s;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <!-- 🐟 Ikon Ikan di Kiri Atas -->
        <a class="navbar-brand" href="{{ route('fishes.index') }}">
        🐟 Fish It Simulator
        </a>
    </div>
</nav>

<div class="main-container container mt-5 pt-4">
    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>

<footer>
    <small>© {{ date('Y') }} Fish It Simulator — crafted with 🐟 by Dewi Astuti Muchtar</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
