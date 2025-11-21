@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Stok Produk</h1>

<div class="flex justify-between items-center bg-white p-5 rounded-xl shadow border border-pinkSoft/20 mb-6">

    <form method="GET" class="flex items-center gap-4">
        <label class="font-semibold text-gray-700 whitespace-nowrap">
            Pilih Gudang:
        </label>

        <select 
            name="warehouse_id" 
            onchange="this.form.submit()" 
            class="p-3 rounded-lg border border-pinkSoft/40 
                   focus:ring-2 focus:ring-pinkSoft outline-none text-gray-700 bg-white shadow-sm min-w-[220px]"
        >
            <option value="">Semua Gudang</option>
            @foreach($warehouses as $w)
                <option value="{{ $w->id }}" @if($warehouse_id == $w->id) selected @endif>
                    {{ $w->name }}
                </option>
            @endforeach
        </select>
    </form>

    <a href="{{ route('stocks.transfer') }}" 
       class="px-5 py-2 bg-pinkSoft hover:bg-pinkDark text-white rounded-lg shadow transition font-semibold">
        + Transfer Stok
    </a>

</div>

<div class="bg-white shadow-lg rounded-xl overflow-hidden border border-greenSoft/20">
    <table class="w-full text-left">
        <thead>
            <tr class="bg-gradient-to-r from-pinkSoft to-greenSoft text-white">
                <th class="p-3 text-sm font-semibold">Produk</th>
                <th class="p-3 text-sm font-semibold">Kategori</th>
                <th class="p-3 text-sm font-semibold text-center">Stok</th>
            </tr>
        </thead>

        <tbody>
            @foreach($products as $p)
            <tr class="border-b hover:bg-pinkSoft/10 transition">
                <td class="p-3">{{ $p->name }}</td>
                <td class="p-3">{{ $p->category->name ?? '-' }}</td>
                <td class="p-3 text-center">
                    @php
                        $qty = $p->warehouses->first()?->pivot->quantity ?? 0;
                    @endphp
                    <span class="font-semibold">{{ $qty }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $products->links() }}
</div>
@endsection
