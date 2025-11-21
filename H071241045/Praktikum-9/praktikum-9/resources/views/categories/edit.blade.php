@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Kategori</h1>

<div class="bg-white p-8 rounded-xl shadow-lg border border-greenSoft/20 max-w-3xl mx-auto">
    <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="font-semibold text-gray-700 text-lg">Nama Kategori</label>
            <input 
                name="name" 
                value="{{ $category->name }}"
                class="w-full mt-1 p-4 text-lg rounded-lg border border-greenSoft/40 focus:ring-2 focus:ring-greenSoft outline-none"
            >
        </div>

        <div>
            <label class="font-semibold text-gray-700 text-lg">Deskripsi</label>
            <textarea 
                name="description"
                class="w-full mt-1 p-4 text-lg rounded-lg border border-greenSoft/40 focus:ring-2 focus:ring-pinkSoft outline-none"
                rows="5"
            >{{ $category->description }}</textarea>
        </div>

        <button 
            class="px-6 py-3 bg-pinkSoft hover:bg-pinkDark text-white text-lg rounded-lg shadow transition">
            Update
        </button>
    </form>
</div>
@endsection
