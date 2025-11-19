@extends('layouts.app')

@section('content')
<h2 class="text-3xl font-bold text-gray-800 mb-6">Daftar Produk</h2>

<a href="{{ route('products.create') }}"
   class="px-5 py-2 bg-pinkSoft hover:bg-pinkDark text-white rounded-lg shadow transition">
    + Tambah Produk
</a>

<div class="mt-6 bg-white shadow-lg rounded-xl overflow-hidden border border-pinkSoft/20">
    <table class="w-full text-left">
        <thead>
            <tr class="bg-gradient-to-r from-pinkSoft to-greenSoft text-white">
                <th class="p-3 font-semibold text-sm">Nama</th>
                <th class="p-3 font-semibold text-sm">Kategori</th>
                <th class="p-3 font-semibold text-sm">Harga</th>
                <th class="p-3 font-semibold text-sm text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $p)
            <tr class="border-b hover:bg-pinkSoft/10 transition">
                <td class="p-3">{{ $p->name }}</td>
                <td class="p-3">{{ $p->category->name }}</td>
                <td class="p-3">{{ 'Rp ' . number_format($p->price, 0, ',', '.') }}</td>

                <!-- Aksi diratakan dan dibuat lebih rapi -->
                <td class="p-3 text-center">
                    <div class="flex justify-center space-x-4 text-sm font-semibold">

                        <a href="{{ route('products.show', $p->id) }}"
                           class="text-blue-600 hover:text-blue-800 transition">
                            Lihat
                        </a>

                        <a href="{{ route('products.edit', $p->id) }}"
                           class="text-yellow-600 hover:text-yellow-700 transition">
                            Edit
                        </a>

                        <form action="{{ route('products.destroy', $p->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-600 hover:text-red-800 transition">
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
@endsection
