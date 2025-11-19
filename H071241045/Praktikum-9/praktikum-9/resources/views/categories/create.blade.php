@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Tambah Kategori</h1>

<div class="bg-white p-8 rounded-xl shadow-lg border border-pinkSoft/20 max-w-3xl mx-auto">
    <form action="{{ route('categories.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="font-semibold text-gray-700 text-lg">Nama Kategori</label>
            <input 
                name="name" 
                required
                class="w-full mt-1 p-4 text-lg rounded-lg border border-pinkSoft/40 focus:ring-2 focus:ring-pinkSoft outline-none"
                placeholder="Masukkan nama kategori"
            >
        </div>

        <div>
            <label class="font-semibold text-gray-700 text-lg">Deskripsi</label>
            <textarea 
                name="description"
                class="w-full mt-1 p-4 text-lg rounded-lg border border-pinkSoft/40 focus:ring-2 focus:ring-greenSoft outline-none"
                placeholder="Masukkan deskripsi kategori"
                rows="5"
            ></textarea>
        </div>

        <button 
            class="px-6 py-3 bg-greenSoft hover:bg-greenDark text-white text-lg rounded-lg shadow transition">
            Simpan
        </button>
    </form>
</div>
@endsection
