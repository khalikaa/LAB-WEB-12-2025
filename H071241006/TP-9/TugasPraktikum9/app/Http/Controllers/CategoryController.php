<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index() 
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function edit(Category $category)
    {
        // Mengirim objek $category yang ditemukan ke view
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // Memastikan data yang masuk sesuai aturan validasi
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Memperbarui record kategori
        $category->update($validatedData);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function create() 
    {
        return view('categories.create');
    }

    public function store(Request $req)
    {
        // 1. Logika untuk menyimpan kategori baru
        $data = $req->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Category::create($data);

        return redirect()->route('categories.index')
            ->with('success','Kategori dibuat');
    } // <-- TUTUP FUNGSI store() DI SINI

    // 2. Logika untuk menghapus kategori (destroy)
    public function destroy(Category $category)
    {
        try {
            // Cek apakah ada produk yang terikat dengan kategori ini sebelum dihapus
            if ($category->products()->exists()) {
                return back()->with('error', 'Gagal menghapus kategori. Masih ada produk yang menggunakan kategori ini.');
            }
            
            $category->delete();
            
            return redirect()->route('categories.index')
                ->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus kategori. Terjadi kesalahan sistem.');
        }

        if ($category->products()->exists()) {
    // Kategori TIDAK akan dihapus, dan pesan error ini yang akan muncul.
    return back()->with('error', 'Gagal menghapus kategori. Masih ada produk yang menggunakan kategori ini.');
}
    } 

} 