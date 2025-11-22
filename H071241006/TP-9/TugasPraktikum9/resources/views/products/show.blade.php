@extends('layouts.app')

@section('content')
<h2>Detail Produk</h2>

<a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">Kembali</a>

<table class="table">
<tr>
    <th>Nama Produk</th>
    <td>{{ $product->name }}</td>
</tr>
<tr>
    <th>Harga</th>
    <td>Rp {{ number_format($product->price, 2) }}</td>
</tr>
<tr>
    <th>Kategori</th>
    <td>{{ $product->category->name ?? '-' }}</td>
</tr>
<tr>
    <th>Deskripsi</th>
    <td>{{ $product->detail->description }}</td>
</tr>
<tr>
    <th>Berat</th>
    <td>{{ $product->detail->weight }} kg</td>
</tr>
<tr>
    <th>Ukuran</th>
    <td>{{ $product->detail->size }}</td>
</tr>

<tr>
    <th>Stok per Gudang</th>
    <td>
        <ul>
            @foreach ($product->warehouses as $w)
                <li>{{ $w->name }} — {{ $w->pivot->quantity }} unit</li>
            @endforeach
        </ul>
    </td>
</tr>

</table>

@endsection
