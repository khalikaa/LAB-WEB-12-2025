@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Tambah Gudang Baru</h2>

        <form action="{{ route('warehouses.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Gudang</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required>

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Lokasi (Opsional)</label>
                <textarea name="location" class="form-control">{{ old('location') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('warehouses.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection