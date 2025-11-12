<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Fish Name *</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $fish->name ?? '') }}">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Rarity *</label>
        <select name="rarity" class="form-select @error('rarity') is-invalid @enderror">
            <option value="">Select Rarity</option>
            @foreach($rarities as $r)
                <option value="{{ $r }}" {{ old('rarity', $fish->rarity ?? '') == $r ? 'selected' : '' }}>
                    {{ $r }}
                </option>
            @endforeach
        </select>
        @error('rarity') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Base Weight Min (kg) *</label>
        <input type="number" step="0.01" name="base_weight_min" class="form-control @error('base_weight_min') is-invalid @enderror"
               value="{{ old('base_weight_min', $fish->base_weight_min ?? '') }}">
        @error('base_weight_min') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Base Weight Max (kg) *</label>
        <input type="number" step="0.01" name="base_weight_max" class="form-control @error('base_weight_max') is-invalid @enderror"
               value="{{ old('base_weight_max', $fish->base_weight_max ?? '') }}">
        @error('base_weight_max') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Sell Price / kg *</label>
        <input type="number" name="sell_price_per_kg" class="form-control @error('sell_price_per_kg') is-invalid @enderror"
               value="{{ old('sell_price_per_kg', $fish->sell_price_per_kg ?? '') }}">
        @error('sell_price_per_kg') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Catch Probability (%) *</label>
        <input type="number" step="0.01" name="catch_probability" class="form-control @error('catch_probability') is-invalid @enderror"
               value="{{ old('catch_probability', $fish->catch_probability ?? '') }}">
        @error('catch_probability') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $fish->description ?? '') }}</textarea>
</div>
