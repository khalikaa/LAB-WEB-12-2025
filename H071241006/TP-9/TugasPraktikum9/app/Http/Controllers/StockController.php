<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\ProductWarehouse;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $warehouses = Warehouse::all();
        $selectedWarehouseId = $request->warehouse_id;

        // Jika user memilih gudang → tampilkan stok per gudang
        if ($selectedWarehouseId) {
            $stocks = ProductWarehouse::where('warehouse_id', $selectedWarehouseId)
                ->with('product')
                ->get();

            return view('stock.index', compact(
                'warehouses',
                'stocks',
                'selectedWarehouseId'
            ));
        }

        // Jika tidak memilih gudang → tampilkan semua stok
        $rows = ProductWarehouse::with(['product', 'warehouse'])->get();

        return view('stock.index_all', compact('rows', 'warehouses'));
    }


    public function createTransfer()
    {
        $warehouses = Warehouse::all();
        $products = Product::all();

        return view('stock.transfer', compact('warehouses', 'products'));
    }


    public function storeTransfer(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'warehouse_id' => 'required',
            'quantity' => 'required|integer'
        ]);

        // Cari stok per gudang & per produk
        $row = ProductWarehouse::where('product_id', $request->product_id)
            ->where('warehouse_id', $request->warehouse_id)
            ->first();

        // Jika belum ada stok → buat baru
        if (!$row) {
            if ($request->quantity < 0) {
                return back()->with('error', 'Stok tidak boleh minus karena belum ada stok.');
            }

            ProductWarehouse::create([
                'product_id' => $request->product_id,
                'warehouse_id' => $request->warehouse_id,
                'quantity' => $request->quantity
            ]);

            return back()->with('success', 'Stok berhasil ditambahkan.');
        }

        // Jika mengurangi stok
        if ($request->quantity < 0 && $row->quantity + $request->quantity < 0) {
            return back()->with('error', 'Jumlah stok tidak cukup. Stok tidak boleh minus.');
        }

        // Update stok
        $row->quantity += $request->quantity;
        $row->save();

        return back()->with('success', 'Stok berhasil diperbarui.');
    }
}
