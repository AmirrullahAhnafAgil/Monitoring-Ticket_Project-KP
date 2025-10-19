@extends('layouts.main')

@section('title', 'Dashboard - User')

@section('content')
<div class="card-custom mb-4">
  <h3 class="mb-1">Halo, {{ $user->name }} 👋</h3>
  <p class="text-muted mb-3">Selamat datang di Sistem Monitoring Tiket. Di sini Anda bisa membuat tiket baru dan memantau progresnya.</p>

  <div class="d-flex flex-wrap gap-2">
    <a href="{{ route('tickets.create') }}" class="btn-glow">Buat Tiket</a>
    <a href="{{ route('tickets.index') }}" class="btn btn-light">Daftar Tiket Saya</a>
  </div>
</div>

<div class="row g-3">
  <div class="col-md-6">
    <div class="card p-3">
      <h6>Total Tiket Anda</h6>
      <p class="h3 mb-0">{{ $totalTickets ?? '--' }}</p>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card p-3">
      <h6>Tiket Terbuka</h6>
      <p class="h3 mb-0 text-warning">{{ $openTickets ?? '--' }}</p>
    </div>
  </div>
</div>

{{-- Tiket terbaru user --}}
<div class="card mt-4 p-3">
  <h5>Tiket Terbaru Anda</h5>
  <table class="table table-dark table-striped mb-0">
    <thead>
      <tr>
        <th>No Tiket</th>
        <th>Aktivitas</th>
        <th>Status</th>
        <th>Dibuat</th>
      </tr>
    </thead>
    <tbody>
      @forelse($myTickets as $t)
        <tr>
          <td>{{ $t->no_tiket }}</td>
          <td><a href="{{ route('tickets.show', $t->id) }}" class="text-white">{{ $t->aktivitas }}</a></td>
          <td>
            @if($t->status === 'open')
              <span class="badge bg-warning text-dark">Open</span>
            @elseif($t->status === 'in_progress')
              <span class="badge bg-info">In Progress</span>
            @else
              <span class="badge bg-success">Closed</span>
            @endif
          </td>
          <td>{{ $t->created_at->format('d M Y') }}</td>
        </tr>
      @empty
        <tr><td colspan="4" class="text-center">Belum ada tiket</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection