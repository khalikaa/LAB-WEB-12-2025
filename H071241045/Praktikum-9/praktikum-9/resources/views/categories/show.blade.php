@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Detail Kategori</h1>

<div class="bg-white p-8 rounded-xl shadow-lg border border-pinkSoft/20 max-w-3xl mx-auto">
    <p class="mb-4 text-lg">
        <strong class="text-pinkDark">Nama:</strong><br>
        {{ $category->name }}
    </p>

    <p class="text-lg">
        <strong class="text-greenDark">Deskripsi:</strong><br>
        {{ $category->description }}
    </p>
</div>

<a href="{{ route('categories.index') }}" 
   class="mt-5 inline-block px-6 py-3 bg-gray-600 text-white text-lg rounded-lg hover:bg-gray-700 transition">
    Kembali
</a>
@endsection
