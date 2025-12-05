<div class="form-group">
    <label for="name">Nama Kategori</label>
    <input type="text" name="name" id="name" class="form-control" 
           value="{{ old('name', $category->name ?? '') }}" required>
</div>

<div class="form-group">
    <label for="description">Deskripsi</label>
    <textarea name="description" id="description" class="form-control">{{ old('description', $category->description ?? '') }}</textarea>
</div>