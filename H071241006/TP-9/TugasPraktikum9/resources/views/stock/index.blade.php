@extends('layout')

@section('content')
    <h2>Manajemen Stok Per Gudang</h2>
    
    <a href="{{ route('stock.transfer.create') }}" class="btn btn-success" style="margin-bottom: 20px;">Transfer/Mutasi Stok</a>

    <form method="GET" action="{{ route('stock.index') }}">
        <div class="form-group" style="display: flex; gap: 10px; align-items: center;">
            <label for="warehouse_id" style="min-width: 150px; font-weight: bold;">Filter Berdasarkan Gudang:</label>
            <select name="warehouse_id" id="warehouse_id" class="form-control" style="width: 300px;">
                <option value="">-- Tampilkan Semua Gudang --</option>
                @foreach ($warehouses as $warehouse)
                    <option value="{{ $warehouse->id }}" {{ $selectedWarehouseId == $warehouse->id ? 'selected' : '' }}>
                        {{ $warehouse->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary" style="flex-shrink: 0;">Tampilkan Stok</button>
        </div>
    </form>

    <h3 style="margin-top: 30px;">
        @if ($selectedWarehouseId)
            Stok Produk di Gudang: {{ $warehouses->find($selectedWarehouseId)->name ?? 'Tidak Ditemukan' }}
        @else
            Stok Semua Gudang (Total Per Produk)
        @endif
    </h3>

    @if ($selectedWarehouseId && $stocks->isEmpty())
        <p>Tidak ada stok yang tercatat di gudang ini (atau stok = 0).</p>
    @elseif ($stocks->isEmpty() && !$selectedWarehouseId)
        <p>Silakan pilih gudang untuk melihat daftar stok, atau tambahkan stok pertama Anda.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Jumlah Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stocks as $stock)
                    <tr>
                        <td>{{ $stock->product_id }}</td>
                        <td>{{ $stock->product->name }}</td>
                        <td>{{ $stock->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection