{{-- Bagian Informasi Produk Utama --}}

<div class="form-group">
    <label for="name">Nama Produk</label>
    <input type="text" name="name" id="name" class="form-control" 
           value="{{ old('name', $product->name ?? '') }}">
</div>

<div class="form-group">
    <label for="price">Harga Produk (Rp)</label>
    <input type="number" name="price" id="price" class="form-control" step="0.01" 
           value="{{ old('price', $product->price ?? '') }}">
</div>

<div class="form-group">
    <label for="category_id">Kategori</label>
    <select name="category_id" id="category_id" class="form-control">
        
        <option value="">-- Tanpa Kategori --</option>
        
        @foreach ($categories as $category)
            <option 
                value="{{ $category->id }}"
                {{ 
                    old($product->category_id ?? '') == $category->id ? 'selected' : '' 
                }}
            >
                {{ $category->name }}
            </option>
        @endforeach
        
    </select>
</div>

<hr>

<h3>Detail Produk</h3>

<div class="form-group">
    <label for="description">Deskripsi Lengkap</label>
    <textarea name="description" id="description" class="form-control">{{ old('description', $product->detail->description ?? '') }}</textarea>
</div>