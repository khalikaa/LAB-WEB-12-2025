@extends('layouts.app')

@section('title', 'Add Fish')

@section('content')
<h2 class="mb-4">Add New Fish</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('fishes.store') }}">
            @csrf
            @include('fishes.partials.form', ['fish' => null])
            <button class="btn btn-primary">Save Fish</button>
            <a href="{{ route('fishes.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
