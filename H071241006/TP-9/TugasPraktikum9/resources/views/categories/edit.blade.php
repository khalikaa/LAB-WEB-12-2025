@extends('layout')

@section('content')
<h2>Edit Category</h2>

<form method="POST" action="{{ route('categories.update', $category->id) }}">
    @csrf @method('PUT')

    <label>Name:</label>
    <input name="name" value="{{ $category->name }}" required>

    <label>Description:</label>
    <textarea name="description">{{ $category->description }}</textarea>

    <button class="btn">Update</button>
</form>

<a href="{{ route('categories.index') }}">Back</a>
@endsection
