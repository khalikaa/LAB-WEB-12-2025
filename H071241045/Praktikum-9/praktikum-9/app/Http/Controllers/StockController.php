<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $warehouses = Warehouse::all();
        $warehouse_id = $request->get('warehouse_id');

        $products = Product::with(['warehouses' => function ($q) use ($warehouse_id) {
            if ($warehouse_id) {
                $q->where('warehouses.id', $warehouse_id);
            }
        }])->paginate(20);

        return view('stocks.index', compact('products', 'warehouses', 'warehouse_id'));
    }

    public function create()
    {
        $warehouses = Warehouse::all();
        $products   = Product::all();

        return view('stocks.transfer', compact('warehouses', 'products'));
    }

    public function store(Request $request)
    {
        // Validasi sesuai input terbaru
        $data = $request->validate([
            'warehouse_id' => 'required|exists:warehouses,id',
            'product_name' => 'required|string',
            'quantity'     => 'required|integer|not_in:0'
        ]);

        // Cari produk berdasarkan nama yang diketik
        $product = Product::where('name', $data['product_name'])->first();

        if (!$product) {
            return back()->withErrors([
                'product_name' => 'Produk tidak ditemukan di database.'
            ])->withInput();
        }

        // Ambil gudang
        $warehouse = Warehouse::findOrFail($data['warehouse_id']);

        // Ambil stok saat ini
        $pivot = $warehouse->products()->where('product_id', $product->id)->first();
        $currentStock = $pivot ? (int)$pivot->pivot->quantity : 0;

        // Hitung stok baru
        $newStock = $currentStock + (int)$data['quantity'];

        // Cegah stok negatif
        if ($newStock < 0) {
            return back()->withErrors([
                'quantity' => 'Stok tidak boleh kurang dari 0.'
            ])->withInput();
        }

        // Update stok
        $warehouse->products()->syncWithoutDetaching([
            $product->id => ['quantity' => $newStock]
        ]);

        return redirect()->route('stocks.index')
                         ->with('success', 'Stok berhasil diperbarui!');
    }
}
