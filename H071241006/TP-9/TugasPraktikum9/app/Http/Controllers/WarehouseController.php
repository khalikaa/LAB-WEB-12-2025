<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        return view('warehouses.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:warehouses,name',
            'location' => 'nullable|string',
        ]);

        Warehouse::create($validatedData);

        return redirect()->route('warehouses.index')->with('success', 'Gudang berhasil ditambahkan.');
    }

    public function edit(Warehouse $warehouse)
    {
        return view('warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:warehouses,name,' . $warehouse->id,
            'location' => 'nullable|string',
        ]);

        $warehouse->update($validatedData);

        return redirect()->route('warehouses.index')->with('success', 'Gudang berhasil diperbarui.');
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return redirect()->route('warehouses.index')->with('success', 'Gudang berhasil dihapus.');
    }
}