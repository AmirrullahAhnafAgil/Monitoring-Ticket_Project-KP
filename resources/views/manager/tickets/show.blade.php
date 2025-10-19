@extends('layouts.main')

@section('title', 'Detail Tiket - Manager')

@section('content')
<div class="card-custom mb-4">
  <h3 class="mb-3">Detail Tiket</h3>

  <div class="mb-3">
    <strong>No Tiket:</strong> {{ $ticket->id }}
  </div>
  <div class="mb-3">
    <strong>Aktivitas:</strong> {{ $ticket->aktivitas }}
  </div>
  <div class="mb-3">
    <strong>Deskripsi:</strong>
    <p>{{ $ticket->deskripsi }}</p>
  </div>
  <div class="mb-3">
    <strong>Pemohon:</strong> {{ $ticket->user->name ?? '—' }}
  </div>
  <div class="mb-3">
    <strong>Status:</strong>
    <span class="badge 
      @if($ticket->status == 'open') bg-success 
      @elseif($ticket->status == 'in_progress') bg-warning text-dark
      @else bg-secondary @endif">
      {{ ucfirst($ticket->status) }}
    </span>
  </div>
  <div class="mb-3">
    <strong>Dibuat:</strong> {{ $ticket->created_at->format('d M Y H:i') }}
  </div>
  <div class="mb-3">
    <strong>Terakhir Diperbarui:</strong> {{ $ticket->updated_at->format('d M Y H:i') }}
  </div>

  <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection