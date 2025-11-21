@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Edit Produk</h2>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- === DATA PRODUK UTAMA === --}}
            <h4 class="mb-3">Data Produk Utama</h4>

            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                    value="{{ old('price', $product->price) }}" required step="0.01">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{-- Logika: Cek inputan user (old) dulu, kalau tidak ada baru cek
                            data asli database --}} {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr class="my-4">

            {{-- === DATA DETAIL PRODUK === --}}
            <h4 class="mb-3">Data Detail Produk</h4>
            <p class="text-muted small">
                Catatan: Jika produk ini belum punya detail, data di bawah ini akan dibuatkan.
            </p>

            <div class="mb-3">
                <label class="form-label">Deskripsi (Opsional)</label>
                {{-- Perhatikan: old('description', $product->detail->description ?? '') --}}
                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                    rows="3">{{ old('description', $product->detail->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Berat (kg)</label>
                <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror"
                    value="{{ old('weight', $product->detail->weight ?? '') }}" required step="0.01">
                @error('weight')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Ukuran (misal: 15 inch)</label>
                <input type="text" name="size" class="form-control @error('size') is-invalid @enderror"
                    value="{{ old('size', $product->detail->size ?? '') }}">
                @error('size')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-success">Perbarui Produk</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection