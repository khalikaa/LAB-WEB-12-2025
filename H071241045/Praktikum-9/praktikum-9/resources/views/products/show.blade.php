@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Detail Produk</h1>

<div class="bg-white p-8 rounded-xl shadow-lg border border-pinkSoft/20 max-w-3xl mx-auto space-y-4">
    <p class="text-lg">
        <strong class="text-pinkDark">Nama:</strong><br>
        {{ $product->name }}
    </p>

    <p class="text-lg">
        <strong class="text-greenDark">Harga:</strong><br>
        Rp {{ number_format($product->price,0,',','.') }}
    </p>

    <p class="text-lg">
        <strong class="text-pinkDark">Kategori:</strong><br>
        {{ $product->category->name ?? '-' }}
    </p>

    <p class="text-lg">
        <strong class="text-greenDark">Deskripsi:</strong><br>
        {{ $product->detail->description }}
    </p>

    <p class="text-lg">
        <strong class="text-pinkDark">Berat:</strong><br>
        {{ $product->detail->weight }} kg
    </p>

    <p class="text-lg">
        <strong class="text-greenDark">Ukuran:</strong><br>
        {{ $product->detail->size }}
    </p>
</div>

<h2 class="text-2xl font-bold text-gray-800 mt-10 mb-4">Stok di Gudang</h2>

<div class="bg-white p-6 rounded-xl shadow border border-greenSoft/20 max-w-3xl mx-auto">
    <table class="w-full">
        <thead class="bg-gradient-to-r from-pinkSoft to-greenSoft text-white">
            <tr>
                <th class="p-3">Gudang</th>
                <th class="p-3">Stok</th>
            </tr>
        </thead>

        <tbody>
            @foreach($product->warehouses as $w)
            <tr class="border-b hover:bg-pinkSoft/10 transition">
                <td class="p-3">{{ $w->name }}</td>
                <td class="p-3">{{ $w->pivot->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<a href="{{ route('products.index') }}" 
   class="mt-6 inline-block px-6 py-3 bg-gray-600 text-white text-lg rounded-lg hover:bg-gray-700 transition">
    Kembali
</a>
@endsection
