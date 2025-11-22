<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Produk</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        header { background: #f4f4f4; padding: 10px; margin-bottom: 20px; }
        nav a { margin-right: 15px; text-decoration: none; font-weight: bold; }
        .container { width: 80%; margin: 0 auto; }
        .alert-success { color: green; border: 1px solid green; padding: 10px; margin-bottom: 15px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>

<header>
    <h1>Product Management System</h1>
    <nav>
        <a href="{{ route('products.index') }}">Products</a> |
      <a href="{{ route('warehouses.index') }}">Warehouses</a> |
      <a href="{{ route('categories.index') }}">Categories</a> |
      <a href="{{ route('stock.index') }}">Stock</a>
    </nav>
</header>

<div class="container">
    @if(session('success')) 
        <div class="alert alert-success">{{ session('success') }}</div> 
    @endif
    
    @if($errors->any()) 
        <div class="alert alert-danger" style="color:red; border: 1px solid red; padding: 10px; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div> 
    @endif
    
    @yield('content')
</div>


</body>
</html>