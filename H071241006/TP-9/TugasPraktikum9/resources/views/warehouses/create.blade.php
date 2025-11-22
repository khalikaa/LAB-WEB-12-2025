@extends('layout')
@section('content')
    <div class="container">
        <h1>Tambah Gudang Baru</h1>
        <form method="POST" action="{{ route('warehouses.store') }}">
            @csrf
            @include('warehouses.form')
        </form>
    </div>
@endsection