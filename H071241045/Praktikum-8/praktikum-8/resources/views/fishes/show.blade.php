@extends('layouts.app')

@section('title', 'Detail Ikan - ' . $fish->name)

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Card Detail -->
    <div class="bg-cyan-900/40 backdrop-blur-sm rounded-xl p-8 border border-cyan-600/50 shadow-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Info Ikan -->
            <div class="space-y-6">
                <div>
                    <h3 class="text-cyan-300 text-sm font-semibold mb-2">🐟 Nama Ikan</h3>
                    <p class="text-white text-2xl font-bold">{{ $fish->name }}</p>
                </div>

                <div>
                    <h3 class="text-cyan-300 text-sm font-semibold mb-2">⭐ Tingkat Kelangkaan</h3>
                    <span class="inline-block px-4 py-2 text-sm font-bold text-white bg-cyan-600 rounded-full">
                        {{ $fish->rarity }}
                    </span>
                </div>

                <div>
                    <h3 class="text-cyan-300 text-sm font-semibold mb-2">⚖️ Rentang Berat</h3>
                    <p class="text-white text-lg">{{ $fish->formatted_weight_range }}</p>
                    <div class="mt-2 text-sm text-cyan-200/80">
                        Min: {{ $fish->base_weight_min }} kg | Max: {{ $fish->base_weight_max }} kg
                    </div>
                </div>
            </div>

            <!-- Info Ekonomi & Catch -->
            <div class="space-y-6">
                <div class="bg-cyan-700/30 border border-cyan-500/50 rounded-lg p-4">
                    <h3 class="text-cyan-300 text-sm font-semibold mb-2">💰 Harga Jual</h3>
                    <p class="text-cyan-200 text-3xl font-bold">{{ $fish->formatted_price }}</p>
                    <p class="text-cyan-100/80 text-sm mt-1">per kilogram</p>
                </div>

                <div class="bg-cyan-800/30 border border-cyan-600/50 rounded-lg p-4">
                    <h3 class="text-cyan-300 text-sm font-semibold mb-2">🎣 Peluang Tertangkap</h3>
                    <p class="text-cyan-200 text-3xl font-bold">{{ $fish->catch_probability }}%</p>
                    <div class="w-full bg-gray-700 rounded-full h-2 mt-3">
                        <div class="bg-cyan-400 h-2 rounded-full transition-all duration-500" 
                            style="width: {{ min($fish->catch_probability, 100) }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deskripsi -->
        @if($fish->description)
            <div class="mt-8 pt-8 border-t border-cyan-600/50">
                <h3 class="text-cyan-300 text-sm font-semibold mb-3">📝 Deskripsi</h3>
                <p class="text-white text-lg leading-relaxed">
                    {{ $fish->description }}
                </p>
            </div>
        @endif

        <!-- Tombol Aksi -->
        <div class="mt-10 pt-8 border-t border-cyan-600/50">
            <div class="flex flex-wrap justify-center gap-4 sm:gap-6">
                <a href="{{ route('fishes.index') }}" 
                    class="px-6 py-3 bg-gray-700 hover:bg-gray-800 text-white rounded-lg transition duration-300 shadow-md w-full sm:w-auto text-center">
                    ← Kembali ke Daftar
                </a>

                <a href="{{ route('fishes.edit', $fish) }}" 
                    class="px-6 py-3 bg-cyan-500 hover:bg-cyan-600 text-black font-semibold rounded-lg transition duration-300 shadow-md w-full sm:w-auto text-center">
                    ✏️ Edit Ikan
                </a>

                <form action="{{ route('fishes.destroy', $fish) }}" method="POST" 
                    onsubmit="return confirm('Yakin ingin menghapus ikan {{ $fish->name }}?')" 
                    class="w-full sm:w-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-300 shadow-md w-full sm:w-auto text-center">
                        🗑️ Hapus Ikan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
