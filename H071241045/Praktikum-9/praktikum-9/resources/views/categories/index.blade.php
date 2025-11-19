@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Kategori</h1>

<a href="{{ route('categories.create') }}"
   class="px-5 py-2 bg-pinkSoft hover:bg-pinkDark text-white rounded-lg shadow transition">
    + Tambah Kategori
</a>

<div class="mt-6 bg-white shadow-lg rounded-xl overflow-hidden border border-pinkSoft/20">
    <table class="w-full text-left">
        <thead>
            <tr class="bg-gradient-to-r from-pinkSoft to-greenSoft text-white">
                <th class="p-3 font-semibold text-sm">Nama</th>
                <th class="p-3 font-semibold text-sm">Deskripsi</th>
                <th class="p-3 font-semibold text-sm text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($categories as $c)
            <tr class="border-b hover:bg-pinkSoft/10 transition">
                <td class="p-3">{{ $c->name }}</td>
                <td class="p-3">{{ $c->description }}</td>

                <td class="p-3 text-center">
                    <div class="flex justify-center space-x-4 text-sm font-semibold">

                        <a class="text-blue-600 hover:text-blue-800 transition"
                           href="{{ route('categories.show', $c) }}">
                            Lihat
                        </a>

                        <a class="text-yellow-600 hover:text-yellow-700 transition"
                           href="{{ route('categories.edit', $c) }}">
                            Edit
                        </a>

                        <form action="{{ route('categories.destroy', $c) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-800 transition">
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
    {{ $categories->links() }}
</div>
@endsection
