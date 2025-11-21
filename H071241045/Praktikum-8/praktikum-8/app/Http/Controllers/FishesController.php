<?php

namespace App\Http\Controllers;

use App\Models\Fishes;
use Illuminate\Http\Request;

class FishesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index(Request $request)
    {
        $query = Fishes::query();

        if ($request->has('rarity') && $request->rarity != '') {
            $query->where('rarity', $request->rarity);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

    
        $query->orderByRaw("
            CASE rarity
                WHEN 'Common' THEN 1
                WHEN 'Uncommon' THEN 2
                WHEN 'Rare' THEN 3
                WHEN 'Epic' THEN 4
                WHEN 'Legendary' THEN 5
                WHEN 'Mythic' THEN 6
                WHEN 'Secret' THEN 7
                ELSE 8
            END
        ")->orderBy('name', 'asc'); 

        $fishes = $query->paginate(10)->withQueryString();

    
        $rarities = Fishes::select('rarity')->distinct()->pluck('rarity')->toArray();

        return view('fishes.index', compact('fishes', 'rarities'));
    }

    public function create()
    {
        
        $rarities = Fishes::select('rarity')->distinct()->pluck('rarity')->toArray();
        return view('fishes.create', compact('rarities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|max:100',
            'rarity' => 'required|in:Common,Uncommon,Rare,Epic,Legendary,Mythic,Secret',
            'base_weight_min' => 'required|numeric|min:0',
            'base_weight_max' => 'required|numeric|gt:base_weight_min',
            'sell_price_per_kg' => 'required|integer|min:0',
            'catch_probability' => 'required|numeric|min:0.01|max:100',
            'description' => 'nullable|string'
        ], [
            'base_weight_max.gt' => 'Berat maksimum harus lebih besar dari berat minimum',
            'catch_probability.min' => 'Probabilitas minimal 0.01%',
            'catch_probability.max' => 'Probabilitas maksimal 100%'
        ]);

        // Simpan data
        Fishes::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('fishes.index')->with('success', 'Ikan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fishes $fish)
    {
        return view('fishes.show', compact('fish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fishes $fish)
    {
        // Ambil rarity dari database (biar konsisten)
        $rarities = Fishes::select('rarity')->distinct()->pluck('rarity')->toArray();
        return view('fishes.edit', compact('fish', 'rarities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fishes $fish)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|max:100',
            'rarity' => 'required|in:Common,Uncommon,Rare,Epic,Legendary,Mythic,Secret',
            'base_weight_min' => 'required|numeric|min:0',
            'base_weight_max' => 'required|numeric|gt:base_weight_min',
            'sell_price_per_kg' => 'required|integer|min:0',
            'catch_probability' => 'required|numeric|min:0.01|max:100',
            'description' => 'nullable|string'
        ]);

        // Update data
        $fish->update($validated);

        return redirect()->route('fishes.index')->with('success', 'Ikan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fishes $fish)
    {
        $fish->delete();
        return redirect()->route('fishes.index')->with('success', 'Ikan berhasil dihapus!');
    }
}
