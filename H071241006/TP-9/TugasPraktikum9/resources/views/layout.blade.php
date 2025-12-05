<!DOCTYPE html>
<html>
<head>
    <title>Product Management</title>
    <style>
        body {
            background: #ffffffff;
            color: #000000ff;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h1, h2 {
            color: #000000ff;
        }

        a {
            color: #000000ff;
            text-decoration: none;
        }
        a:hover { text-decoration: underline; }

        .nav a {
            margin-right: 12px;
            font-weight: bold;
        }

        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }

        th {
            background: #ffffffff;
            color: #000000ff;
            border: 1px solid #000000ff;
            padding: 10px;
        }

        td {
            border: 1px solid #000000ff;
            padding: 10px;
        }

        .btn {
            background: #ffffffff;
            color: #000000ff;
            padding: 6px 10px;
            border: 1px solid #000000ff;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background: #ffffffff;
        }

        input, select, textarea {
            background: #fafcffff;
            border: 1px solid #000000ff;
            padding: 8px;
            color: #000000ff;
            width: 300px;
            border-radius: 4px;
            margin-top: 4px;
            margin-bottom: 10px;
        }

        button {
            margin-top: 5px;
        }

        hr {
            border: 1px solid #000000ff;
            margin: 15px 0;
        }

    </style>
</head>
<body>

<h1>Product Management</h1>

<div class="nav">
    <a href="{{ route('products.index') }}">Products</a> |
    <a href="{{ route('warehouses.index') }}">Warehouses</a> |
    <a href="{{ route('categories.index') }}">Categories</a> |
    <a href="{{ route('stock.index') }}">Stock</a>
</div>

@yield('content')

</body>
</html>
