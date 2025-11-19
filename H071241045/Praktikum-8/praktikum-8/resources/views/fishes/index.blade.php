@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('title', 'Daftar Ikan')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-white mb-3">🐟 Daftar Ikan</h1>
        <p class="text-cyan-300/80">Lihat semua ikan yang sudah terdaftar di sistem</p>
    </div>

    <!-- Filter dan Search -->
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <form method="GET" action="{{ route('fishes.index') }}" class="flex flex-wrap gap-4 w-full md:w-auto">
            <select name="rarity" class="px-4 py-2 bg-cyan-950/50 border border-cyan-700 rounded-lg text-white">
                <option value="">Semua Rarity</option>
                @foreach($rarities as $rarity)
                    <option value="{{ $rarity }}" {{ request('rarity') == $rarity ? 'selected' : '' }}>
                        {{ $rarity }}
                    </option>
                @endforeach
            </select>

            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari ikan..."
                class="px-4 py-2 bg-cyan-950/50 border border-cyan-700 rounded-lg text-white placeholder-cyan-500/50 focus:outline-none focus:border-cyan-500">

            <button type="submit"
                class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition duration-300">
                🔍 Filter
            </button>
        </form>

        <a href="{{ route('fishes.create') }}"
            class="px-6 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition duration-300">
            ➕ Tambah Ikan
        </a>
    </div>

    <!-- Tabel Daftar Ikan -->
    <div class="overflow-x-auto bg-cyan-900/30 backdrop-blur-sm rounded-xl border border-cyan-700/50">
        <table class="min-w-full text-white">
            <thead>
                <tr class="text-cyan-300 border-b border-cyan-700/50">
                    <th class="py-3 px-4 text-left">Nama</th>
                    <th class="py-3 px-4 text-left">Rarity</th>
                    <th class="py-3 px-4 text-left">Berat (kg)</th>
                    <th class="py-3 px-4 text-left">Harga/kg</th>
                    <th class="py-3 px-4 text-left">Prob (%)</th>
                    <th class="py-3 px-4 text-left">Deskripsi</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($fishes as $fish)
                    <tr class="border-b border-cyan-800/40 hover:bg-cyan-800/30 transition">
                        <td class="py-3 px-4 font-semibold text-cyan-100">{{ $fish->name }}</td>
                        <td class="py-3 px-4">
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-bold text-white {{ $fish->rarity_color }}">
                                {{ $fish->rarity }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-cyan-200">{{ $fish->formatted_weight_range }}</td>
                        <td class="py-3 px-4 text-yellow-300">{{ $fish->formatted_price }}</td>
                        <td class="py-3 px-4 text-purple-300">{{ $fish->catch_probability }}%</td>

                        <!-- ✅ Tambahan: Deskripsi singkat -->
                        <td class="py-3 px-4 text-cyan-300">
                            {{ $fish->description ? Str::limit($fish->description, 50, '...') : '-' }}
                        </td>

                        <!-- ✅ Tambahan: Tombol Detail -->
                        <td class="py-3 px-4 text-center">
                            <a href="{{ route('fishes.show', $fish) }}" 
                                class="text-cyan-400 hover:text-cyan-300 font-semibold mr-3">
                                👁️ Detail
                            </a>
                            <form action="{{ route('fishes.destroy', $fish) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin ingin menghapus ikan {{ $fish->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-400 font-semibold">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-6 text-center text-cyan-400">
                            Tidak ada data ikan ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $fishes->links() }}
    </div>
</div>
@endsection
