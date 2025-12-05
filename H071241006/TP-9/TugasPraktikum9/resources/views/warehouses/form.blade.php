<div class="form-group">
    <label for="name">Nama Gudang</label>
    <input type="text" class="form-control" id="name" name="name" 
           value="{{ $warehouse->name ?? old('name') }}" required>
    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="location">Lokasi Gudang (Opsional)</label>
    <textarea class="form-control" id="location" name="location">{{ $warehouse->location ?? old('location') }}</textarea>
    @error('location')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="btn btn-success">Simpan</button>
<a href="{{ route('warehouses.index') }}" class="btn btn-secondary">Batal</a>