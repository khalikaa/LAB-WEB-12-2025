<?php

namespace App\Http\Controllers;

use App\Models\Fish; 
use Illuminate\Http\Request; 
use Illuminate\Validation\Rule;

class FishController extends Controller
{   
    private $rarityLevels = ['Common' , 'Uncommon' , 'Rare' , 'Epic' , 'Legendary', 'Mythic' , 'Secret']; 
    //Tugas A 
    public function index(Request $request)
    {
        $query = Fish::query();
        if($request->has('rarity') && $request->rarity!= ''){
            $query->where('rarity' , $request->rarity);
        }
        $fishes = $query->orderBy('id' , 'asc')->paginate(10);
        $rarities = $this->rarityLevels;
        return view('fishes.index' , compact('fishes' , 'rarities')); 
    }
    //Tugas B:
    public function create()
    {
        $rarities = $this->rarityLevels;
        return view('fishes.create' , compact('rarities'));
    }
        public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:100|unique:fishes', //unique agar nama ikan tdk ada yang sama
            'rarity' => ['required', Rule::in($this->rarityLevels)], //Harus salah satu dari 7 lvl
            "base_weight_min" => 'required|numeric|min:0.01',
            'base_weight_max' => 'required|numeric|gt:base_weight_min', 
            'sell_price_per_kg' => 'required|integer|min:1',
            'catch_probability' => 'required|numeric|min:0.01|max:100', 
            'description' => 'nullable|string', //boleh null
        ]);
        $fish = Fish::create($validateData);
        return redirect()->route('fishes.index')
                        ->with('success' , 'Data Ikan Berhasil Ditambahkan');
    } 
    public function show(Fish $fish) 
    {
        return view('fishes.show', compact('fish'));
    }
    //Tugas D 
    public function edit(Fish $fish)
    {
        $rarities = $this->rarityLevels;
        return view('fishes.edit' , compact('fish' , 'rarities'));
    }
    public function update(Request $request, Fish $fish)
    {
        $validateData = $request->validate([
            'name' => [
                'required',
                "string",
                "max:100",
                Rule::unique('fishes')->ignore($fish->id)
            ],
            "rarity" => ['required', Rule::in($this->rarityLevels)],
            "base_weight_min" => 'required|numeric|min:0.01',
            'base_weight_max' => 'required|numeric|gt:base_weight_min',
            "sell_price_per_kg" => 'required|integer|min:1',
            'catch_probability'=> 'required|numeric|min:0.01|max:100',
            'description'=> 'nullable|string',
        ]);
        $fish->update($validateData);
        return redirect()->route('fishes.index')
                        ->with('success', 'Data ikan berhasil di perbarui');
    }
    public function destroy(Fish $fish)
    {
        $fish->delete();
        return redirect()->route('fishes.index')
                        ->with('success', 'Data ikan berhasil dihapus');
    }
}
