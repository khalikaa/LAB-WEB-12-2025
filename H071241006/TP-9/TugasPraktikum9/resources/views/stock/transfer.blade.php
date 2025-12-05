@extends('layout')

@section('content')
    <h2>Transfer / Mutasi Stok</h2>
    <p>Gunakan nilai positif (+) untuk menambah stok dan nilai negatif (-) untuk mengurangi stok. Pengurangan stok tidak diizinkan jika hasilnya akan membuat stok menjadi minus.</p>

    <form action="{{ route('stock.transfer.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="warehouse_id">Pilih Gudang:</label>
            <select name="warehouse_id" id="warehouse_id" class="form-control" required>
                <option value="">-- Pilih Gudang --</option>
                @foreach ($warehouses as $warehouse)
                    <option value="{{ $warehouse->id }}" {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                        {{ $warehouse->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="product_id">Pilih Produk:</label>
            <select name="product_id" id="product_id" class="form-control" required>
                <option value="">-- Pilih Produk --</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="change_amount">Jumlah Stok (+/-)</label>
            <input type="number" name="change_amount" id="change_amount" class="form-control" 
                   value="{{ old('change_amount') }}" required placeholder="Contoh: 10 untuk tambah, -5 untuk kurang">
        </div>

        <button type="submit" class="btn btn-success">Proses Transfer</button>
        <a href="{{ route('stock.index') }}" class="btn btn-secondary" style="background: #6c757d; color: white;">Batal</a>
    </form>
@endsection