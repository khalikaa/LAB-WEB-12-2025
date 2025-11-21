@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Tambah Produk</h1>

<div class="bg-white p-8 rounded-xl shadow-lg border border-pinkSoft/20 max-w-3xl mx-auto">
    <form action="{{ route('products.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="font-semibold text-gray-700 text-lg">Nama Produk</label>
            <input 
                name="name" 
                class="w-full mt-1 p-4 text-lg rounded-lg border border-pinkSoft/40 focus:ring-2 focus:ring-pinkSoft outline-none"
                placeholder="Masukkan nama produk"
                required
            >
        </div>

        <div>
            <label class="font-semibold text-gray-700 text-lg">Harga</label>
            <input 
                name="price" 
                type="number" 
                step="0.01"
                class="w-full mt-1 p-4 text-lg rounded-lg border border-greenSoft/40 focus:ring-2 focus:ring-greenSoft outline-none"
                placeholder="Masukkan harga"
                required
            >
        </div>

        <div>
            <label class="font-semibold text-gray-700 text-lg">Kategori</label>
            <select 
                name="category_id"
                class="w-full mt-1 p-4 text-lg rounded-lg border border-pinkSoft/40 focus:ring-2 focus:ring-pinkSoft outline-none"
            >
                <option value="">-- Tidak Ada Kategori --</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="font-semibold text-gray-700 text-lg">Deskripsi</label>
            <textarea 
                name="description"
                class="w-full mt-1 p-4 text-lg rounded-lg border border-greenSoft/40 focus:ring-2 focus:ring-greenSoft outline-none"
                rows="4"
                placeholder="Masukkan deskripsi produk"
            ></textarea>
        </div>

        <div>
            <label class="font-semibold text-gray-700 text-lg">Berat (kg)</label>
            <input 
                name="weight" 
                type="number"
                step="0.01"
                class="w-full mt-1 p-4 text-lg rounded-lg border border-pinkSoft/40 focus:ring-2 focus:ring-pinkSoft outline-none"
                placeholder="Masukkan berat"
                required
            >
        </div>

        <div>
            <label class="font-semibold text-gray-700 text-lg">Ukuran</label>
            <input 
                name="size"
                class="w-full mt-1 p-4 text-lg rounded-lg border border-greenSoft/40 focus:ring-2 focus:ring-greenSoft outline-none"
                placeholder="Masukkan ukuran"
            >
        </div>

        <button 
            class="px-6 py-3 bg-greenSoft hover:bg-greenDark text-white text-lg rounded-lg shadow transition">
            Simpan
        </button>
    </form>
</div>
@endsection
