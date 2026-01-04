@extends('layouts.main')

@section('title', 'Dashboard - User')

@section('content')

<div class="card-custom mb-4">
  <h3 class="mb-1">Halo, {{ $user->name }} 👋</h3>
  <p class="text-muted mb-3">
    Selamat datang di Sistem Monitoring Tiket. Pantau tiket Anda dengan mudah.
  </p>

  <div class="d-flex flex-wrap gap-2">
    <a href="{{ route('tickets.create') }}" class="btn btn-light">
      Buat Tiket
    </a>
    <a href="{{ route('tickets.index') }}" class="btn btn-light">
      Tiket Saya
    </a>
  </div>
</div>

{{-- STATISTIK USER --}}
<div class="row g-3">
  <div class="col-12">
    <div class="card p-3">
      <div class="row text-center align-items-center">

        <div class="col-md-6 border-end">
          <h6 class="mb-1 text-muted">Total Tiket Anda</h6>
          <p class="h2 mb-0 text-dark">
            {{ $totalTickets }}
          </p>
        </div>

        <div class="col-md-6">
          <h6 class="mb-1 text-muted">Tiket Terbuka</h6>
          <p class="h2 mb-0 text-warning">
            {{ $openTickets }}
          </p>
        </div>

      </div>
    </div>
  </div>
</div>

{{-- TIKET TERBARU USER --}}
<div class="card mt-4 p-3">
  <h5 class="mb-3 text-dark">Tiket Terbaru Anda</h5>

  <div class="table-responsive">
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
            <td>
              <a href="{{ route('tickets.show', $t->id) }}" class="text-white text-decoration-none">
                {{ $t->aktivitas }}
              </a>
            </td>
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
          <tr>
            <td colspan="4" class="text-center text-muted">
              Belum ada tiket
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection