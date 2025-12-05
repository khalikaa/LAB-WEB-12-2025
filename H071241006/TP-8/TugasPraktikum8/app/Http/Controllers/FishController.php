<?php

namespace App\Http\Controllers;

use App\Models\Fish;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FishController extends Controller
{
    protected $rarities = ['Common','Uncommon','Rare','Epic','Legendary','Mythic','Secret'];

    public function index(Request $request)
    {
        $query = Fish::query();

        // Optional: search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by rarity (scope)
        if ($request->filled('rarity')) {
            $query->rarity($request->rarity);
        }

        // Sorting: name / sell_price_per_kg / catch_probability
        $sortable = ['name', 'sell_price_per_kg', 'catch_probability'];
        $sort = $request->get('sort', 'id');
        $direction = $request->get('dir', 'asc') === 'desc' ? 'desc' : 'asc';
        if (in_array($sort, $sortable)) {
            $query->orderBy($sort, $direction);
        } else {
            $query->orderBy('id', 'desc');
        }

        $fishes = $query->paginate(10)->appends($request->query());

        return view('fishes.index', compact('fishes'))
            ->with('rarities', $this->rarities);
    }

    public function create()
    {
        return view('fishes.create')->with('rarities', $this->rarities);
    }

    public function store(Request $request)
    {
        $request->validate([ // <--- Ganti menjadi $request->validate
            'name' => 'required|string|max:100',
            'rarity' => ['required', Rule::in($this->rarities)],
            'base_weight_min' => 'required|numeric|min:0.00',
            'base_weight_max' => 'required|numeric|gt:base_weight_min',
            'sell_price_per_kg' => 'required|integer|min:0',
            'catch_probability' => 'required|numeric|min:0.01|max:100',
            'description' => 'nullable|string',
        ]);

        Fish::create($request->only([
// ...
            'name','rarity','base_weight_min','base_weight_max','sell_price_per_kg','catch_probability','description'
        ]));

        return redirect()->route('fishes.index')->with('success', 'Ikan berhasil ditambahkan.');
    }

    public function show(Fish $fish)
    {
        return view('fishes.show', compact('fish'))->with('rarities', $this->rarities);
    }

    public function edit(Fish $fish)
    {
        return view('fishes.edit', compact('fish'))->with('rarities', $this->rarities);
    }

    public function update(Request $request, Fish $fish)
    {
        $valData = $request->validate([
            'name' => 'required|string|max:100',
            'rarity' => ['required', Rule::in($this->rarities)],
            'base_weight_min' => 'required|numeric|min:0.00',
            'base_weight_max' => 'required|numeric|gt:base_weight_min',
            'sell_price_per_kg' => 'required|integer|min:0',
            'catch_probability' => 'required|numeric|min:0.01|max:100',
            'description' => 'nullable|string',
        ]);

        $fish->update($valData);

        return redirect()->route('fishes.show', $fish)->with('success', 'Data ikan berhasil diperbarui.');
    }

    public function destroy(Fish $fish)
    {
        $fish->delete();
        return redirect()->route('fishes.index')->with('success', 'Ikan berhasil dihapus.');
    }
}
