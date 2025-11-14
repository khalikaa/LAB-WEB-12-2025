@extends('layouts.app')

@section('title', 'Fish Details')

@section('content')
<a href="{{ route('fishes.index') }}" class="btn btn-secondary mb-3">← Back</a>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">{{ $fish->name }} Details</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr><th>ID</th><td>{{ $fish->id }}</td></tr>
            <tr><th>Name</th><td>{{ $fish->name }}</td></tr>
            <tr><th>Rarity</th><td><span class="badge bg-info">{{ $fish->rarity }}</span></td></tr>
            <tr><th>Weight Range</th><td>{{ $fish->formatted_weight }}</td></tr>
            <tr><th>Sell Price</th><td>{{ $fish->formatted_price }}</td></tr>
            <tr><th>Catch Probability</th><td>{{ $fish->catch_probability }}%</td></tr>
            <tr><th>Description</th><td>{{ $fish->description ?? '-' }}</td></tr>
            <tr><th>Created At</th><td>{{ $fish->created_at->format('d M Y H:i') }}</td></tr>
            <tr><th>Updated At</th><td>{{ $fish->updated_at->format('d M Y H:i') }}</td></tr>
        </table>

        <div class="d-flex gap-2 mt-3">
            <a href="{{ route('fishes.edit', $fish) }}" class="btn btn-warning">Edit</a>
            <form method="POST" action="{{ route('fishes.destroy', $fish) }}" onsubmit="return confirm('Delete this fish?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
