@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Detail Kategori: {{ $category->name }}</h2>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Informasi Kategori</h5>
                <p class="card-text"><strong>Deskripsi:</strong> {{ $category->description ?? 'Tidak ada deskripsi' }}</p>
            </div>
        </div>

        <h4>Daftar Produk di Kategori Ini</h4>
        @if($category->products->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category->products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->name }}</td>
                            <td>Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info">Belum ada produk di kategori ini.</div>
        @endif
    </div>
@endsection