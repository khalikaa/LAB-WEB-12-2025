@extends('layouts.app')

@section('content')
<h3>Detail Ikan - {{ $fish->name }}</h3>

<div class="card mb-3">
  <div class="card-body">
    <h5 class="card-title">{{ $fish->name }} <small class="text-muted">({{ $fish->rarity }})</small></h5>

    <p><strong>Berat:</strong> {{ $fish->formatted_weight_range }}</p>
    <p><strong>Harga Jual:</strong> {{ $fish->formatted_price }}</p>
    <p><strong>Peluang Tertangkap:</strong> {{ number_format($fish->catch_probability, 2) }}%</p>
    <p><strong>Deskripsi:</strong><br> {!! nl2br(e($fish->description ?: '-')) !!}</p>

    <p class="text-muted small">
      Dibuat: {{ $fish->created_at->format('d M Y H:i:s') }} <br>
      Terakhir diupdate: {{ $fish->updated_at->format('d M Y H:i:s') }}
    </p>

    <a href="{{ route('fishes.edit', $fish) }}" class="btn btn-warning">Edit</a>

    <form action="{{ route('fishes.destroy', $fish) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete()">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger">Hapus</button>
    </form>

    <a href="{{ route('fishes.index') }}" class="btn btn-secondary">Kembali ke daftar</a>
  </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(){
  return confirm('Yakin ingin menghapus ikan ini? Tindakan ini tidak bisa dikembalikan.');
}
</script>
@endpush
