@extends('layouts.app')

@section('title', 'Edit Fish')

@section('content')
<h2 class="mb-4">Edit Fish</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('fishes.update', $fish) }}">
            @csrf
            @method('PUT')
            @include('fishes.partials.form', ['fish' => $fish])
            <button class="btn btn-success">Update Fish</button>
            <a href="{{ route('fishes.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
