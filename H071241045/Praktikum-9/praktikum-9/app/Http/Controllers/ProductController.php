<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(15);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required',
            'price'       => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable',
            'weight'      => 'required|numeric',
            'size'        => 'nullable'
        ]);

        DB::transaction(function () use ($data) {
            $product = Product::create([
                'name'        => $data['name'],
                'price'       => $data['price'],
                'category_id' => $data['category_id'] ?? null,
            ]);

            ProductDetail::create([
                'product_id'  => $product->id,
                'description' => $data['description'] ?? null,
                'weight'      => $data['weight'],
                'size'        => $data['size'] ?? null,
            ]);
        });

        return redirect()->route('products.index')->with('success', 'Produk berhasil dibuat');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'detail', 'warehouses']);
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('detail');

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'required',
            'price'       => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable',
            'weight'      => 'required|numeric',
            'size'        => 'nullable'
        ]);

        DB::transaction(function () use ($product, $data) {
            $product->update([
                'name'        => $data['name'],
                'price'       => $data['price'],
                'category_id' => $data['category_id'] ?? null,
            ]);

            if ($product->detail) {
                $product->detail->update([
                    'description' => $data['description'] ?? null,
                    'weight'      => $data['weight'],
                    'size'        => $data['size'] ?? null
                ]);
            } else {
                ProductDetail::create([
                    'product_id'  => $product->id,
                    'description' => $data['description'] ?? null,
                    'weight'      => $data['weight'],
                    'size'        => $data['size'] ?? null,
                ]);
            }
        });

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }
}
