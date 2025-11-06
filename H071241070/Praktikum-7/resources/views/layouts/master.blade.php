<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>@yield('title', 'Eksplor Nusantara')</title>
    
    <style>
        /* CSS Untuk Body */
        body { 
            font-family: sans-serif; 
            margin: 0; 
            display: flex; 
            flex-direction: column; 
            min-height: 100vh; 
            background-color: #fff; /* Latar belakang body putih */
        }
        
        /* CSS BARU UNTUK NAVIGASI (Gantikan CSS <header> dan <nav> lama) */
        .navbar-container {
            background-color: white; /* Latar belakang putih seperti di foto */
            border-bottom: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05); /* Shadow tipis */
            
            /* Atur padding (jarak) atas/bawah 15px, kiri/kanan 30px */
            padding: 15px 30px; 
            
            /* KUNCI UTAMA: FLEXBOX */
            display: flex;
            justify-content: space-between; /* Mendorong judul ke kiri & menu ke kanan */
            align-items: center; /* Membuat semuanya sejajar di tengah (vertikal) */
        }

        .navbar-brand a {
            text-decoration: none;
            color: #FFA500; /* Warna gelap untuk brand */
            font-size: 1.7em; /* (Mirip "Teknologi Cerdas") */
            font-weight: 700; /* Bold */
        }

        .navbar-menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex; /* Bikin menu jadi horizontal */
        }

        .navbar-menu li {
            margin-left: 25px; /* Jarak antar item menu (sesuaikan) */
        }

        .navbar-menu a {
            text-decoration: none;
            color: #555; /* Warna abu-abu untuk link */
            font-weight: 500; /* (Mirip "Tentang", "Fitur" di foto) */
            font-size: 1em;
        }
        .navbar-menu a:hover {
            color: #FFA500; /* (Warna biru saat hover) */
        }
        /* AKHIR CSS BARU NAVIGASI */
        
        main { 
            flex: 1; /* Hanya untuk mendorong footer */
        }

        /* Ini adalah container default kita */
        .container {
            padding: 20px; 
            max-width: 1000px; 
            margin: 0 auto; 
            width: 100%;
            box-sizing: border-box;
        }

        /* CSS (Meniru Tampilan Tailwind) */
        .hero-tailwind-style {
            position: relative; /* (Mirip 'relative') */
            background-size: cover; /* (Mirip 'bg-cover') */
            background-position: center; /* (Mirip 'bg-center') */
            height: 70vh; /* (Mirip 'h-[70vh]') */
            color: white; /* (Mirip 'text-white') */
            
            /* (Mirip 'flex justify-center items-center') */
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center; /* (Mirip 'text-center') */
        }

        .hero-overlay {
            position: absolute; /* (Mirip 'absolute') */
            top: 0; left: 0; right: 0; bottom: 0; /* (Mirip 'inset-0') */
            background-color: black; /* (Mirip 'bg-black') */
            opacity: 0.6; /* (Mirip 'opacity-60') */
        }
        
        .hero-text-content {
            position: relative; /* (Mirip 'relative', agar di atas overlay) */
            z-index: 2;
            padding: 1rem; /* (Mirip 'p-4') */
        }
        
        .hero-text-content h1 {
            font-size: 3rem; /* (Mirip 'text-5xl') */
            font-weight: 800; /* (Mirip 'font-extrabold') */
            line-height: 1.2; /* (Mirip 'leading-tight') */
        }
        
        .hero-text-content p {
            margin-top: 1rem; /* (Mirip 'mt-4') */
            font-size: 1.125rem; /* (Mirip 'text-xl') */
            max-width: 42rem; /* (Mirip 'max-w-2xl') */
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            margin-top: 2rem; /* (Mirip 'mt-8') */
        }
        
        .hero-buttons a {
            text-decoration: none;
            font-weight: 600; /* (Mirip 'font-semibold') */
            padding: 0.75rem 1.5rem; /* (Mirip 'py-3 px-8') */
            border-radius: 9999px; /* (Mirip 'rounded-full') */
            transition: all 0.3s ease; /* (Mirip 'transition-colors duration-300') */
            margin: 0 0.5rem; /* (Mirip 'space-x-4') */
        }
        
        .btn-primary {
            background-color: #FFA500; /* (Mirip 'bg-indigo-600') */
            color: white;
        }
        .btn-primary:hover {
            background-color: #E69500;/* (Mirip 'hover:bg-indigo-700') */
        }

        .btn-secondary {
            background-color: transparent;
            border: 2px solid white; /* (Mirip 'border border-white') */
            color: white;
        }
        .btn-secondary:hover {
            background-color: white;
            color: #FFA500; /* (Mirip 'hover:bg-white hover:text-indigo-600') */
        }

        /* CSS untuk konten "Tentang" (RATA TENGAH) */
        .content-tentang {
            padding: 40px 0; /* Jarak dari hero */
            text-align: center; /* Rata tengah */
        }
        .content-tentang h2 {
            font-size: 2em;

        }
        /* CSS UNTUK KOMPONEN CARD */
        .destinasi-container {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr; /* 3 kolom */
            gap: 20px;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            overflow: hidden; 
            transition: all 0.3s ease;
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover; 
        }
        .card-content {
            padding: 15px;
        }
        .card-content h3 {
            margin-top: 0;
            color: #FFA500;
        }
        
        /* Responsif untuk Card */
        @media (max-width: 768px) {
            .destinasi-container {
                grid-template-columns: 1fr; /* 1 kolom */
            }
        }
        
        /* MEMPERBESAR FONT PENJELASAN */
        .content-tentang p,
        .card-content p {
            font-size: 1.2em; /* Membuat font 10% lebih besar */
            line-height: 1.6; /* Menambah jarak antar baris */
        }
        
        /* CSS GALERI */
        .gallery-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr); 
            gap: 15px;
        }
        .gallery-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .gallery-item img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }
        
        
        /* CSS KONTAK */
        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
        .contact-info {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        .contact-info h3 { margin-top: 0; color: #FFA500; }
        .contact-form .form-group { margin-bottom: 15px; }
        .contact-form label { display: block; margin-bottom: 5px; font-weight: bold; }
        .contact-form input,
        .contact-form textarea {

            width: 100%; padding: 10px; border: 1px solid #ddd;
            border-radius: 5px; box-sizing: border-box;
        }
        .contact-form button {
            background-color: #FFA500; color: white; padding: 12px 20px;
            border: none; border-radius: 5px; font-size: 1em; cursor: pointer;
        }
        .contact-form button:hover { background-color: #E69500; }
        @media (max-width: 768px) {
            .contact-container { grid-template-columns: 1fr; }
        }
        
        /* CSS FOOTER */
        footer { 
            background-color: #343a40; 
            color: white; 
            text-align: center; 
            padding: 20px; 
            margin-top: auto; /* Ini mendorong footer ke bawah */
        }
        /* CSS BARU UNTUK EFEK HOVER */
        .card:hover,
        .gallery-item:hover {
            transform: scale(1.05); /* Bikin 5% lebih besar (zoom) */
            box-shadow: 0 10px 20px rgba(0,0,0,0.2); /* Bikin bayangan lebih tebal (terangkat) */
            z-index: 10; /* (Memastikan item yang di-hover ada di paling depan) */
        }
    </style>
</head>
<body>
    <nav class="navbar-container">
        
        <div class="navbar-brand">
            <a href="/">Eksplorasi Bone</a>
        </div>
        
        <ul class="navbar-menu">
            <li><a href="/">Home</a></li>
            <li><a href="/destinasi">Destinasi</a></li>
            <li><a href="/kuliner">Kuliner</a></li>
            <li><a href="/galeri">Galeri</a></li>
            <li><a href="/kontak">Kontak</a></li>
        </ul>
    </nav>

    <main class = "@yield('main_class', 'container')">
        @yield('content') 
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Eksplor Nusantara. All Rights Reserved.</p>
    </footer>
</body>
</html>