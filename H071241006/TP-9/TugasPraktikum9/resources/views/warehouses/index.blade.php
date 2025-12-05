@extends('layout') 

@section('content')
    <div class="container">
        <h2>Manajemen Warehouse</h2>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <a href="{{ route('warehouses.create') }}" class="btn btn-primary mb-3">Tambah Gudang Baru</a>

        <table class="table" border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Gudang</th>
                    <th>Lokasi</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($warehouses as $warehouse)
                    <tr>
                        <td>{{ $warehouse->id }}</td>
                        <td>{{ $warehouse->name }}</td>
                        <td>{{ $warehouse->location }}</td>
                        <td>{{ $warehouse->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('warehouses.edit', $warehouse->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            
                            <form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus gudang ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection