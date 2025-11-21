@extends('layouts.app')

{{-- Judulnya dinamis, mengambil nama ikan dari Controller --}}
@section('title', 'Detail: ' . $fish->name)

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            {{-- Judul Halaman --}}
            <h2>Detail Ikan: {{ $fish->name }}</h2>
            
            {{-- Tombol Kembali ke Index --}}
            <a href="{{ route('fishes.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Informasi Lengkap</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 30%;">ID</th>
                            <td>{{ $fish->id }}</td>
                        </tr>
                        <tr>
                            <th>Nama Ikan</th>
                            <td>{{ $fish->name }}</td>
                        </tr>
                        <tr>
                            <th>Rarity</th>
                            <td>
                                {{-- Logika badge yang sama seperti di index.blade.php --}}
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
                        </tr>
                        <tr>
                            <th>Berat (Min-Max)</th>
                            <td>{{ $fish->formatted_weight_range }}</td>
                        </tr>
                        <tr>
                            <th>Harga Jual (per Kg)</th>
                            <td>
                                {{-- Kita panggil Accessor 'FormattedSellPrice' dari Model (Nilai Plus) --}}
                                {{ $fish->formatted_sell_price }}
                            </td>
                        </tr>
                        <tr>
                            <th>Peluang Tangkap</th>
                            <td>{{ $fish->catch_probability }}%</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            {{-- 
                                Kita pakai nl2br() agar jika ada 'Enter' di deskripsi,
                                akan ditampilkan sebagai baris baru di HTML
                            --}}
                            <td>{!! nl2br(e($fish->description)) !!}</td>
                        </tr>
                        <tr>
                            <th>Dibuat Pada</th>
                            <td>{{ $fish->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Diperbarui Pada</th>
                            <td>{{ $fish->updated_at->format('d M Y, H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-end">
                {{-- Tombol Aksi (Tugas C) --}}
                <form action="{{ route('fishes.destroy', $fish) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus ikan ini?')">
                    
                    {{-- Tombol Edit --}}
                    <a href="{{ route('fishes.edit', $fish) }}" class="btn btn-warning">Edit</a>

                    {{-- Tombol Hapus --}}
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection