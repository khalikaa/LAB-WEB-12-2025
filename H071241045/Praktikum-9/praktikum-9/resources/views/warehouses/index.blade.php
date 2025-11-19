@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Gudang</h1>

<a href="{{ route('warehouses.create') }}" 
   class="px-5 py-2 bg-pinkSoft hover:bg-pinkDark text-white rounded-lg shadow transition">
    + Tambah Gudang
</a>

<div class="mt-6 bg-white shadow-xl rounded-xl overflow-hidden border border-greenSoft/30">
    <table class="w-full text-left">
        <thead>
            <tr class="bg-gradient-to-r from-pinkSoft to-greenSoft text-white">
                <th class="p-3 font-semibold">Nama</th>
                <th class="p-3 font-semibold">Lokasi</th>
                <th class="p-3 font-semibold text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($warehouses as $w)
            <tr class="border-b hover:bg-pinkSoft/10 transition">
                <td class="p-3">{{ $w->name }}</td>
                <td class="p-3">{{ $w->location }}</td>
                <td class="p-3 text-center">
                    <div class="flex items-center justify-center gap-4">

                        <a href="{{ route('warehouses.edit', $w) }}" 
                           class="text-yellow-600 font-semibold hover:underline">
                            Edit
                        </a>

                        <form action="{{ route('warehouses.destroy', $w) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="text-red-600 font-semibold hover:underline">
                                Hapus
                            </button>
                        </form>

                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $warehouses->links() }}
</div>
@endsection
