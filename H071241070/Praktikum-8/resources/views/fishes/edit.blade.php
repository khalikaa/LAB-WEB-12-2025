@extends('layouts.app')

@section('title', 'Edit Ikan: ' . $fish->name)

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Edit Ikan: {{ $fish->name }}</h2>
            <a href="{{ route('fishes.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

        {{-- Menampilkan Error Validasi (jika ada) --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Ada masalah dengan inputanmu:<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form ini akan mengirim data ke fungsi 'update' di FishController --}}
        <form action="{{ route('fishes.update', $fish) }}" method="POST">
            @csrf 
            @method('PUT') 

            <div class="card">
                <div class="card-body">
                    
                    {{-- Nama Ikan --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Ikan <span class="text-danger">*</span></label>
                        <input type="text" 
                                name="name" 
                                id="name" 
                                class="form-control @error('name') is-invalid @enderror" 
                                {{-- [BERBEDA] Kita isi 'value' dengan data lama dari $fish --}}
                                value="{{ old('name', $fish->name) }}" 
                                placeholder="Contoh: Koi">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Rarity (Dropdown) --}}
                    <div class="mb-3">
                        <label for="rarity" class="form-label">Rarity <span class="text-danger">*</span></label>
                        <select name="rarity" id="rarity" class="form-select @error('rarity') is-invalid @enderror">
                            <option value="" disabled>-- Pilih Rarity --</option>
                            @foreach($rarities as $rarity)
                                {{-- [BERBEDA] Logika 'selected' untuk data lama --}}
                                <option value="{{ $rarity }}" 
                                    {{ old('rarity', $fish->rarity) == $rarity ? 'selected' : '' }}>
                                    {{ $rarity }}
                                </option>
                            @endforeach
                        </select>
                        @error('rarity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Grup Berat (Min & Max) --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="base_weight_min" class="form-label">Berat Minimum (kg) <span class="text-danger">*</span></label>
                            <input type="number" 
                                    name="base_weight_min" 
                                    id="base_weight_min" 
                                    class="form-control @error('base_weight_min') is-invalid @enderror" 
                                    {{-- [BERBEDA] Kita isi 'value' dengan data lama --}}
                                    value="{{ old('base_weight_min', $fish->base_weight_min) }}" 
                                    step="0.01" 
                                    placeholder="Contoh: 0.5">
                            @error('base_weight_min')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="base_weight_max" class="form-label">Berat Maksimum (kg) <span class="text-danger">*</span></label>
                            <input type="number" 
                                    name="base_weight_max" 
                                    id="base_weight_max" 
                                    class="form-control @error('base_weight_max') is-invalid @enderror" 
                                    {{-- [BERBEDA] Kita isi 'value' dengan data lama --}}
                                    value="{{ old('base_weight_max', $fish->base_weight_max) }}" 
                                    step="0.01" 
                                    placeholder="Contoh: 2.5">
                            @error('base_weight_max')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Grup Harga & Peluang --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sell_price_per_kg" class="form-label">Harga Jual (per kg) <span class="text-danger">*</span></label>
                            <input type="number" 
                                    name="sell_price_per_kg" 
                                    id="sell_price_per_kg" 
                                    class="form-control @error('sell_price_per_kg') is-invalid @enderror" 
                                    
                                    value="{{ old('sell_price_per_kg', $fish->sell_price_per_kg) }}"
                                    placeholder="Contoh: 5000">
                            @error('sell_price_per_kg')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="catch_probability" class="form-label">Peluang Tangkap (%) <span class="text-danger">*</span></label>
                            <input type="number" 
                                    name="catch_probability" 
                                    id="catch_probability" 
                                    class="form-control @error('catch_probability') is-invalid @enderror" 
                                    {{-- [BERBEDA] Kita isi 'value' dengan data lama --}}
                                    value="{{ old('catch_probability', $fish->catch_probability) }}" 
                                    step="0.01" 
                                    placeholder="Contoh: 25.5">
                            @error('catch_probability')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi (Opsional)</label>
                        <textarea name="description"id="description"rows="3"class="form-control @error('description') is-invalid @enderror"placeholder="Info unik tentang ikan ini...">{{-- [BERBEDA] Kita isi textarea dengan data lama --}}{{ old('description', $fish->description) }}
                        </textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Update Ikan</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection