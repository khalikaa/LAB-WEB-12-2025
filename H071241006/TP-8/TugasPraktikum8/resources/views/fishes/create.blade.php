@extends('layouts.app')

@section('content')
<h3>Tambah Ikan Baru</h3>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('fishes.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label class="form-label">Nama Ikan</label>
    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required maxlength="100">
  </div>

  <div class="mb-3">
    <label class="form-label">Rarity</label>
    <select name="rarity" class="form-select" required>
      <option value="">-- Pilih Rarity --</option>
      @foreach($rarities as $r)
        <option value="{{ $r }}" {{ old('rarity')==$r ? 'selected' : '' }}>{{ $r }}</option>
      @endforeach
    </select>
  </div>

  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Berat Minimum (kg)</label>
      <input type="number" step="0.01" min="0" name="base_weight_min" value="{{ old('base_weight_min') }}" class="form-control" required>
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Berat Maksimum (kg)</label>
      <input type="number" step="0.01" min="0" name="base_weight_max" value="{{ old('base_weight_max') }}" class="form-control" required>
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Harga Jual per kg (Coins)</label>
    <input type="number" name="sell_price_per_kg" min="0" value="{{ old('sell_price_per_kg') }}" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Peluang Tertangkap (%)</label>
    <input type="number" step="0.01" name="catch_probability" min="0.01" max="100" value="{{ old('catch_probability') }}" class="form-control" required>
    <div class="form-text">Masukkan nilai 0.01 - 100.00</div>
  </div>

  <div class="mb-3">
    <label class="form-label">Deskripsi (opsional)</label>
    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
  </div>

  <button class="btn btn-primary">Simpan</button>
  <a href="{{ route('fishes.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
