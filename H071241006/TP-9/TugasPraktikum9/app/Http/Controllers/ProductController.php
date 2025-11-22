<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(20);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $v = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',

            'description' => 'nullable|string',
            'weight'      => 'required|numeric|min:0',
            'size'        => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $product = Product::create([
                'name'        => $v['name'],
                'price'       => $v['price'],
                'category_id' => $v['category_id'] ?? null,
            ]);

            ProductDetail::create([
                'product_id'  => $product->id,
                'description' => $v['description'] ?? null,
                'weight'      => $v['weight'],
                'size'        => $v['size'] ?? null,
            ]);

            DB::commit();
            return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function show(Product $product)
    {
        $product->load('category', 'detail', 'warehouses');
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $product->load('detail');

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $v = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',

            'description' => 'nullable|string',
            'weight'      => 'required|numeric|min:0',
            'size'        => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $product->update([
                'name'        => $v['name'],
                'price'       => $v['price'],
                'category_id' => $v['category_id'] ?? null,
            ]);

            $product->detail()->updateOrCreate(
                ['product_id' => $product->id],
                [
                    'description' => $v['description'] ?? null,
                    'weight'      => $v['weight'],
                    'size'        => $v['size'] ?? null,
                ]
            );

            DB::commit();
            return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk dihapus.');
    }
}
