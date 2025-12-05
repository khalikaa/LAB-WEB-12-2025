@extends('layout')

@section('content')
    <h2>Semua Stok Produk di Semua Gudang</h2>
    <p>Berikut adalah daftar stok dari semua gudang dalam sistem.</p>

    {{-- Tombol tambah stok --}}
    <button onclick="document.getElementById('addStockModal').style.display='block'"
            class="btn btn-success" style="margin-bottom: 20px;">
        + Tambah Stok
    </button>

    @if ($rows->isEmpty())
        <div style="margin-top: 20px; padding: 15px; background: #f8d7da; border: 1px solid #f5c2c7; color: #842029;">
            Tidak ada data stok.
        </div>

        <a href="{{ route('stock.index') }}" class="btn btn-secondary"
           style="background:#6c757d; color:white; margin-top:15px;">
            Kembali ke Filter
        </a>
    @else
        <table class="table table-bordered" style="margin-top: 20px;">
            <thead style="background: #f0f0f0; font-weight:bold;">
                <tr>
                    <th>Produk</th>
                    <th>Gudang</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                    <tr>
                        <td>{{ $row->product->name ?? '-' }}</td>
                        <td>{{ $row->warehouse->name ?? '-' }}</td>
                        <td>{{ $row->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

       
    @endif


    {{-- Modal Tambah Stok --}}
    <div id="addStockModal" 
         style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
                background:rgba(0,0,0,0.6); padding-top:100px;">

        <div style="background:white; width:40%; margin:auto; padding:20px; border-radius:8px;">
            <h3>Tambah Stok Produk</h3>

            <form action="{{ route('stock.transfer.store') }}" method="POST">
                @csrf

                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Pilih Gudang:</label>
                    <select name="warehouse_id" class="form-control" required>
                        <option value="">-- Pilih Gudang --</option>
                        @foreach ($warehouses as $w)
                            <option value="{{ $w->id }}">{{ $w->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Pilih Produk:</label>
                    <select name="product_id" class="form-control" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach (\App\Models\Product::all() as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Jumlah Stok (+)</label>
                    <input type="number" name="quantity" class="form-control" required placeholder="Contoh: 10">
                </div>

                <button type="submit" class="btn btn-success">Tambah Stok</button>
                <button type="button" 
                        onclick="document.getElementById('addStockModal').style.display='none'"
                        class="btn btn-secondary"
                        style="background:#6c757d; color:white;">
                    Batal
                </button>
            </form>
        </div>
    </div>

@endsection
