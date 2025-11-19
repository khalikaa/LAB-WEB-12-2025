<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $warehouses = Warehouse::all();
        $productsInWarehouse = null;
        $selectedWarehouseId = $request->query('warehouse_id'); 

        if ($selectedWarehouseId) {
            $warehouse = Warehouse::with('products')->find($selectedWarehouseId);
            if ($warehouse) {
                $productsInWarehouse = $warehouse->products;
            }
        }
        return view('stocks.index', compact('warehouses', 'productsInWarehouse', 'selectedWarehouseId'));
    }

    public function createTransfer()
    {
        $warehouses = Warehouse::all();
        $products = Product::all();

        return view('stocks.transfer', compact('warehouses', 'products'));
    }

    public function storeTransfer(Request $request)
    {
        $request->validate([
            'warehouse_id' => 'required|exists:warehouses,id',
            'product_id' => 'required|exists:products,id',
            'quantity_change' => 'required|integer|not_in:0',
        ]);

        $warehouseId = $request->warehouse_id;
        $productId = $request->product_id;
        $change = (int) $request->quantity_change;
        try {
            DB::transaction(function () use ($warehouseId, $productId, $change) {

                $product = Product::find($productId);
                $warehouse = $product->warehouses()->where('warehouse_id', $warehouseId)->first();
                $currentStock = $warehouse ? $warehouse->pivot->quantity : 0;
                $newStock = $currentStock + $change;

                // Validasi minus
                if ($newStock < 0) {
                    throw new \Exception('Stok akhir tidak boleh minus. Stok saat ini: ' . $currentStock);
                }

                // Simpan
                $product->warehouses()->syncWithoutDetaching([
                    $warehouseId => ['quantity' => $newStock]
                ]);
            });

            return redirect()->route('stocks.index')->with('success', 'Stok berhasil diperbarui.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal update stok: ' . $e->getMessage());
        }
    }
}