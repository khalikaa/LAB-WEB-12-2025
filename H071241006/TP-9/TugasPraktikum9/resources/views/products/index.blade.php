@extends('layouts.app')

@section('content')
<h2>Daftar Produk</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">+ Tambah Produk</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($products as $p)
        <tr>
            <td>{{ $p->name }}</td>
            <td>{{ $p->category->name ?? '-' }}</td>
            <td>Rp {{ number_format($p->price, 2) }}</td>
            <td>
                <a href="{{ route('products.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('products.destroy', $p->id) }}" class="d-inline" method="POST"
                      onsubmit="return confirm('Yakin hapus?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $products->links() }}

@endsection
