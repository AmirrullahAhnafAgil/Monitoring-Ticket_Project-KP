@extends('layouts.main')

@section('title', 'Detail Tiket - Admin')

@section('content')
<div class="card-custom">
  <h3 class="mb-3">Detail Tiket #{{ $ticket->id }}</h3>

  <ul class="list-group list-group-flush text-dark">
    <li class="list-group-item"><strong>No Tiket:</strong> {{ $ticket->id }}</li>
    <li class="list-group-item"><strong>Aktivitas:</strong> {{ $ticket->aktivitas }}</li>
    <li class="list-group-item"><strong>Deskripsi:</strong> {{ $ticket->deskripsi }}</li>
    <li class="list-group-item"><strong>Pemohon:</strong> {{ $ticket->user->name ?? '—' }}</li>
    <li class="list-group-item">
      <strong>Status:</strong>
      <span class="badge bg-{{ $ticket->status == 'open' ? 'warning' : ($ticket->status == 'in_progress' ? 'info' : 'success') }}">
        {{ ucfirst($ticket->status) }}
      </span>
    </li>
    <li class="list-group-item"><strong>Dibuat:</strong> {{ $ticket->created_at->format('d M Y H:i') }}</li>
    <li class="list-group-item"><strong>Update Terakhir:</strong> {{ $ticket->updated_at->format('d M Y H:i') }}</li>
  </ul>

  <div class="mt-3">
    <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Kembali</a>
  </div>
</div>
@endsection