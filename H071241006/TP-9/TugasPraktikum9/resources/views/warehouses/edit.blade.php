@extends('layout')
@section('content')
    <div class="container">
        <h1>Edit Gudang: {{ $warehouse->name }}</h1>
        <form method="POST" action="{{ route('warehouses.update', $warehouse->id) }}">
            @csrf
            @method('PUT')
            @include('warehouses.form', ['warehouse' => $warehouse])
        </form>
    </div>
@endsection