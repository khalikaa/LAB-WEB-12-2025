@extends('layouts.app')

@section('content')

<div class="flex justify-center">
    <div class="w-full max-w-3xl">

        {{-- Judul --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
            Tambah Gudang
        </h1>

        {{-- Form --}}
        <form action="{{ route('warehouses.store') }}" 
              method="POST" 
              class="bg-white p-8 shadow-2xl rounded-2xl border border-pinkSoft/30">

            @csrf

            <label class="font-semibold text-gray-700">Nama Gudang</label>
            <input name="name" 
                class="border p-3 w-full rounded-lg mb-5 border-pinkSoft/40 
                       focus:ring-2 focus:ring-pinkSoft outline-none" 
                placeholder="Masukkan nama gudang..."
                required>

            <label class="font-semibold text-gray-700">Lokasi</label>
            <textarea name="location" 
                class="border p-3 w-full rounded-lg mb-5 min-h-[120px]
                       border-greenSoft/40 focus:ring-2 focus:ring-greenSoft outline-none"
                placeholder="Masukkan lokasi gudang..."></textarea>

            <button class="bg-pinkSoft hover:bg-pinkDark text-white px-6 py-2 
                           rounded-lg shadow transition font-semibold">
                Simpan
            </button>

        </form>

    </div>
</div>

@endsection
