@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Transfer Stok Produk</h1>

@if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        <ul class="list-disc ml-6">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('current_stock') !== null)
    <div class="mb-4 bg-blue-100 border border-blue-300 text-blue-800 px-4 py-3 rounded-lg shadow">
        Stok saat ini untuk produk ini di gudang ini: 
        <strong>{{ session('current_stock') }}</strong>
    </div>
@endif

<div class="bg-white p-8 rounded-xl shadow-lg border border-pinkSoft/20 max-w-3xl mx-auto">
    <form action="{{ route('stocks.transfer.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="font-semibold text-gray-700 text-lg">Nama Produk</label>
            
            <input 
                type="text"
                name="product_name"
                placeholder="Masukkan nama produk..."
                list="product_list"
                class="w-full mt-1 p-4 text-lg rounded-lg border border-greenSoft/40 focus:ring-2 focus:ring-greenSoft outline-none"
                required
                value="{{ old('product_name') }}"
            >

            <datalist id="product_list">
                @foreach($products as $p)
                    <option value="{{ $p->name }}">
                @endforeach
            </datalist>
        </div>

        {{-- GUDANG --}}
        <div>
            <label class="font-semibold text-gray-700 text-lg">Pilih Gudang</label>
            <select 
                name="warehouse_id"
                class="w-full mt-1 p-4 text-lg rounded-lg border border-pinkSoft/40 focus:ring-2 focus:ring-pinkSoft outline-none"
                required
            >
                <option value="">-- Pilih Gudang --</option>
                @foreach($warehouses as $w)
                    <option value="{{ $w->id }}" 
                        {{ old('warehouse_id') == $w->id ? 'selected' : '' }}>
                        {{ $w->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="font-semibold text-gray-700 text-lg">
                Jumlah (positif = tambah, negatif = kurangi)
            </label>

            <input 
                type="number" 
                name="quantity"
                placeholder="Contoh: 10 (tambah), -5 (kurangi)"
                class="w-full mt-1 p-4 text-lg rounded-lg border border-greenSoft/40 focus:ring-2 focus:ring-greenSoft outline-none"
                required
                value="{{ old('quantity') }}"
            >
        </div>

        <button 
            class="px-6 py-3 bg-greenSoft hover:bg-greenDark text-white text-lg rounded-lg shadow transition">
            Proses Transfer
        </button>
    </form>
</div>

@endsection
