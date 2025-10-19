@extends('layouts.main')

@section('title', 'Detail Tiket')

@section('content')
<div class="card-custom">
  <h3 class="mb-3">Detail Tiket</h3>

  <div class="mb-3">
    <strong>No Tiket:</strong> {{ $ticket->no_tiket ?? $ticket->id }}
  </div>

  <div class="mb-3">
    <strong>Aktivitas:</strong> {{ $ticket->aktivitas }}
  </div>

  <div class="mb-3">
    <strong>Deskripsi:</strong>
    <p>{{ $ticket->deskripsi }}</p>
  </div>

  {{-- ⚠️ Status dihilangkan untuk user --}}

  <div class="mt-3">
    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn-glow">Edit</a>
  </div>
</div>
@endsection