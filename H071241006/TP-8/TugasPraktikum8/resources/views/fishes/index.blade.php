@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h3>Daftar Ikan</h3>
</div>

<form method="GET" class="row g-2 mb-3">
  <div class="col-md-3">
    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search nama...">
  </div>
  <div class="col-md-3">
    <select name="rarity" class="form-select">
      <option value="">Semua Rarity</option>
      @foreach($rarities as $r)
        <option value="{{ $r }}" {{ request('rarity')==$r ? 'selected' : '' }}>{{ $r }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <select name="sort" class="form-select">
      <option value="">Sort Default</option>
      <option value="name" {{ request('sort')=='name' ? 'selected' : '' }}>Nama</option>
      <option value="sell_price_per_kg" {{ request('sort')=='sell_price_per_kg' ? 'selected' : '' }}>Harga (Coins/kg)</option>
      <option value="catch_probability" {{ request('sort')=='catch_probability' ? 'selected' : '' }}>Peluang</option>
    </select>
  </div>
  <div class="col-md-2">
    <select name="dir" class="form-select">
      <option value="asc" {{ request('dir')=='asc' ? 'selected' : '' }}>Asc</option>
      <option value="desc" {{ request('dir')=='desc' ? 'selected' : '' }}>Desc</option>
    </select>
  </div>
  <div class="col-md-1">
    <button class="btn btn-primary w-100">Filter</button>
  </div>
</form>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nama</th>
      <th>Rarity</th>
      <th>Berat (kg)</th>
      <th>Harga (Coins/kg)</th>
      <th>Peluang (%)</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse($fishes as $fish)
    <tr>
      <td>{{ $fish->id }}</td>
      <td>{{ $fish->name }}</td>
      <td>{{ $fish->rarity }}</td>
      <td>{{ $fish->formatted_weight_range }}</td>
      <td>{{ $fish->formatted_price }}</td>
      <td>{{ number_format($fish->catch_probability, 2) }}%</td>
      <td style="white-space: nowrap;">
        <a href="{{ route('fishes.show', $fish) }}" class="btn btn-sm btn-info">Lihat</a>
        <a href="{{ route('fishes.edit', $fish) }}" class="btn btn-sm btn-warning">Edit</a>

        <form action="{{ route('fishes.destroy', $fish) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete()">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
        </form>
      </td>
    </tr>
    @empty
    <tr><td colspan="7" class="text-center">Tidak ada data ikan.</td></tr>
    @endforelse
  </tbody>
</table>

{{ $fishes->links() }}

@endsection

@push('scripts')
<script>
function confirmDelete(){
  return confirm('Yakin ingin menghapus ikan ini? Tindakan ini tidak bisa dikembalikan.');
}
</script>
@endpush
