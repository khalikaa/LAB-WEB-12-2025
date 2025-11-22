@extends('layout')

@section('content')
    <h2>Tambah Kategori Baru</h2>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        @include('categories.form')
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary" style="background: #6c757d; color: white;">Batal</a>
    </form>
@endsection