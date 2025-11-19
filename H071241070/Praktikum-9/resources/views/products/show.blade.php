@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Detail Produk: {{ $product->name }}</h2>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

        <div class="row">
            {{-- BAGIAN KIRI: Detail Lengkap Produk --}}
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-light fw-bold">Informasi Produk</div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 30%">Nama Produk</th>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $product->category->name ?? 'Tanpa Kategori' }}
                                    </span>
                                </td>
                            </tr>

                            {{-- Pemisah Visual --}}
                            <tr>
                                <td colspan="2">
                                    <hr>
                                </td>
                            </tr>

                            <tr>
                                <th>Deskripsi</th>
                                <td class="text-muted">{{ $product->detail->description ?? 'Tidak ada deskripsi' }}</td>
                            </tr>
                            <tr>
                                <th>Berat</th>
                                <td>{{ $product->detail->weight ?? 0 }} kg</td>
                            </tr>
                            <tr>
                                <th>Ukuran</th>
                                <td>{{ $product->detail->size ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            {{-- BAGIAN KANAN: Info Stok per Gudang --}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Stok di Gudang
                    </div>
                    <ul class="list-group list-group-flush">
                        {{-- Loop data gudang dari relasi Many-to-Many --}}
                        @forelse($product->warehouses as $warehouse)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $warehouse->name }}</strong>
                                    <br>
                                    <small class="text-muted" style="font-size: 0.8em;">{{ $warehouse->location }}</small>
                                </div>

                                {{-- Ambil 'quantity' dari TABEL PIVOT --}}
                                <span class="badge bg-success rounded-pill" style="font-size: 1rem;">
                                    {{ $warehouse->pivot->quantity }}
                                </span>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted py-4">
                                <em>Produk ini belum tersedia di gudang manapun.</em>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection