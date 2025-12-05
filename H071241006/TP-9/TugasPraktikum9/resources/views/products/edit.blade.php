@extends('layouts.app')

@section('content')
<h2>Edit Produk</h2>

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
        <label>Nama Produk</label>
        <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}">
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" step="0.01" class="form-control" name="price" value="{{ old('price', $product->price) }}">
    </div>

    <div class="mb-3">
        <label>Kategori</label>
        <select name="category_id" class="form-control">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $c)
                <option value="{{ $c->id }}" {{ $product->category_id == $c->id ? 'selected' : '' }}>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
    </div>

    <h4>Detail Produk</h4>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="description" class="form-control">{{ old('description', $product->detail->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label>Berat (kg)</label>
        <input type="number" step="0.01" class="form-control" name="weight"
               value="{{ old('weight', $product->detail->weight) }}">
    </div>

    <div class="mb-3">
        <label>Ukuran</label>
        <input type="text" class="form-control" name="size" value="{{ old('size', $product->detail->size) }}">
    </div>

    <button class="btn btn-primary">Perbarui</button>
</form>
@endsection
