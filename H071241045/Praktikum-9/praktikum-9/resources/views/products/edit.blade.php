@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Produk</h1>

<div class="bg-white p-8 rounded-xl shadow-lg border border-greenSoft/20 max-w-3xl mx-auto">
    <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="font-semibold text-gray-700 text-lg">Nama Produk</label>
            <input 
                name="name"
                value="{{ $product->name }}"
                class="w-full mt-1 p-4 text-lg rounded-lg border border-greenSoft/40 focus:ring-2 focus:ring-greenSoft outline-none"
            >
        </div>

        <div>
            <label class="font-semibold text-gray-700 text-lg">Harga</label>
            <input 
                name="price"
                type="number"
                step="0.01"
                value="{{ $product->price }}"
                class="w-full mt-1 p-4 text-lg rounded-lg border border-pinkSoft/40 focus:ring-2 focus:ring-pinkSoft outline-none"
            >
        </div>

        <div>
            <label class="font-semibold text-gray-700 text-lg">Kategori</label>
            <select 
                name="category_id"
                class="w-full mt-1 p-4 text-lg rounded-lg border border-greenSoft/40 focus:ring-2 focus:ring-greenSoft outline-none"
            >
                <option value="">-- Tidak Ada --</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" @if($c->id == $product->category_id) selected @endif>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="font-semibold text-gray-700 text-lg">Deskripsi</label>
            <textarea 
                name="description"
                class="w-full mt-1 p-4 text-lg rounded-lg border border-pinkSoft/40 focus:ring-2 focus:ring-pinkSoft outline-none"
                rows="4"
            >{{ $product->detail->description }}</textarea>
        </div>

        <div>
            <label class="font-semibold text-gray-700 text-lg">Berat (kg)</label>
            <input 
                name="weight"
                type="number"
                step="0.01"
                value="{{ $product->detail->weight }}"
                class="w-full mt-1 p-4 text-lg rounded-lg border border-greenSoft/40 focus:ring-2 focus:ring-greenSoft outline-none"
            >
        </div>

        <div>
            <label class="font-semibold text-gray-700 text-lg">Ukuran</label>
            <input 
                name="size"
                value="{{ $product->detail->size }}"
                class="w-full mt-1 p-4 text-lg rounded-lg border border-pinkSoft/40 focus:ring-2 focus:ring-pinkSoft outline-none"
            >
        </div>

        <button 
            class="px-6 py-3 bg-pinkSoft hover:bg-pinkDark text-white text-lg rounded-lg shadow transition">
            Update
        </button>
    </form>
</div>
@endsection
