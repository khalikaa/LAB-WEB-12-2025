@extends('layouts.app')
@section('title', 'Fish Database')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-semibold text-primary">🐠 Fish Database</h3>
    <a href="{{ route('fishes.create') }}" class="btn btn-primary px-4">+ Add Fish</a>
</div>

<form method="GET" class="row g-2 mb-4">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Search fish name..." value="{{ request('search') }}">
    </div>
    <div class="col-md-3">
        <select name="rarity" class="form-select" onchange="this.form.submit()">
            <option value="">All Rarity</option>
            @foreach($rarities as $r)
                <option value="{{ $r }}" {{ request('rarity') == $r ? 'selected' : '' }}>{{ $r }}</option>
            @endforeach
        </select>
    </div>
</form>

<div class="card p-3">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Rarity</th>
                    <th>Weight</th>
                    <th>Price</th>
                    <th>Catch %</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($fishes as $fish)
                    <tr>
                        <td>{{ $fish->id }}</td>
                        <td class="fw-medium">{{ $fish->name }}</td>
                        <td><span class="badge bg-info text-dark">{{ $fish->rarity }}</span></td>
                        <td>{{ $fish->formatted_weight }}</td>
                        <td>{{ $fish->formatted_price }}</td>
                        <td>{{ $fish->catch_probability }}%</td>
                        <td class="text-end">
                            <a href="{{ route('fishes.show', $fish) }}" class="btn btn-sm btn-outline-primary">View</a>
                            <a href="{{ route('fishes.edit', $fish) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            <form action="{{ route('fishes.destroy', $fish) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this fish?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted">No fish found 🐡</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $fishes->links() }}
    </div>
</div>
@endsection
