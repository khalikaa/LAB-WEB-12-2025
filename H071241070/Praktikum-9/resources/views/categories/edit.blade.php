@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Edit Kategori</h2>

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>

                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $category->name) }}" required>

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi (Opsional)</label>
                <textarea name="description"
                    class="form-control">{{ old('description', $category->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Perbarui</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection