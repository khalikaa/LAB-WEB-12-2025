@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Tambah Gudang</h1>

<form action="{{ route('warehouses.store') }}" 
      method="POST" 
      class="bg-white p-6 shadow-xl rounded-xl border border-pinkSoft/30 max-w-3xl mx-auto">
    @csrf

    <label class="font-semibold text-gray-700">Nama Gudang</label>
    <input name="name" 
           class="border p-3 w-full rounded-lg mb-4 border-pinkSoft/40 focus:ring-2 focus:ring-pinkSoft outline-none" 
           required>

    <label class="font-semibold text-gray-700">Lokasi</label>
    <textarea name="location" 
              class="border p-3 w-full rounded-lg mb-4 border-greenSoft/40 focus:ring-2 focus:ring-greenSoft outline-none"></textarea>

    <button class="bg-pinkSoft hover:bg-pinkDark text-white px-6 py-2 rounded-lg shadow transition">
        Simpan
    </button>
</form>

@endsection
