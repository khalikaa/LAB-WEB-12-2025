{{-- Halaman ini "mewarisi" bingkai dari 'layouts.app' --}}
@extends('layouts.app')

{{-- Ini mengisi slot 'title' di master layout --}}
@section('title', 'Fish Database')

{{-- Ini mengisi slot 'content' di master layout --}}
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Fish Database</h2>
    <a href="{{ route('fishes.create') }}" class="btn btn-primary">Tambah Ikan Baru</a>
</div>

<!-- Form Filter (Tugas A) -->
<div class="card mb-4">
    <div class="card-header">Filter Data</div>
    <div class="card-body">
        <form action="{{ route('fishes.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <label for="rarity" class="form-label">Filter berdasarkan Rarity:</label>
                    <select name="rarity" id="rarity" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Rarity</option>
                        {{-- Ambil data $rarities dari Controller --}}
                        @foreach($rarities as $rarity)
                            <option value="{{ $rarity }}" {{ request('rarity') == $rarity ? 'selected' : '' }}>
                                {{ $rarity }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Akhir Form Filter -->

<!-- Tabel Daftar Ikan (Tugas A) -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama Ikan</th>
                        <th>Rarity</th>
                        <th>Berat (Min-Max)</th>
                        <th>Harga Jual (per Kg)</th>
                        <th>Peluang Tangkap</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop data $fishes dari Controller --}}
                    @forelse($fishes as $fish)
                        <tr>
                            <td>{{ $fish->id }}</td>
                            <td>{{ $fish->name }}</td>
                            <td>
                                <span class="badge 
                                    @if($fish->rarity == 'Common') bg-secondary
                                    @elseif($fish->rarity == 'Uncommon') bg-success
                                    @elseif($fish->rarity == 'Rare') bg-primary
                                    @elseif($fish->rarity == 'Epic') bg-info
                                    @elseif($fish->rarity == 'Legendary') bg-warning text-dark
                                    @elseif($fish->rarity == 'Mythic') bg-danger
                                    @elseif($fish->rarity == 'Secret') bg-dark
                                    @endif">
                                    {{ $fish->rarity }}
                                </span>
                            </td>
                            <td>{{ $fish->formatted_weight_range }}</td>
                            <td>
                                {{ $fish->formatted_sell_price }}
                            </td>
                            <td>{{ $fish->catch_probability }}%</td>
                            <td>
                                <!-- Tombol Aksi (Tugas A) -->
                                <form action="{{ route('fishes.destroy', $fish) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus ikan ini?')">
                                    
                                    <a href="{{ route('fishes.show', $fish) }}" class="btn btn-sm btn-info">Lihat</a>
                                    
                                    <a href="{{ route('fishes.edit', $fish) }}" class="btn btn-sm btn-warning">Edit</a>

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data ikan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination (Tugas A) -->
        <div class="d-flex justify-content-center mt-3">
            {{ $fishes->withQueryString()->links() }}
        </div>

    </div>
</div>

@endsection