@extends('layout')

@section('content')
    <h2>Manajemen Kategori</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Tambah Kategori</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description ?? '-' }}</td>
                    <td class="actions">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                        
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    
    <button type="submit" class="btn btn-danger btn-sm" 
            onclick="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $category->name }}?')">
        Hapus
    </button>
</form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection