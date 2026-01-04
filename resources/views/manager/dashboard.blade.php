@extends('layouts.main')

@section('title', 'Dashboard - Manager')

@section('content')

<div class="card-custom mb-4">
  <h3 class="mb-1">Halo, {{ $user->name }} (Manager)</h3>
  <p class="text-muted mb-3">
    Pantau ringkasan tiket harian. Gunakan tombol di bawah untuk monitoring cepat.
  </p>

  <div class="d-flex flex-wrap gap-2">
    <a href="{{ route('tickets.index') }}" class="btn btn-light">
      Lihat Semua Tiket
    </a>
  </div>
</div>

{{-- STATISTIK --}}
<div class="row g-3">
  <div class="col-12">
    <div class="card p-3">
      <div class="row text-center align-items-center">

        {{-- TOTAL TIKET --}}
        <div class="col-md-6 border-end">
          <h6 class="mb-1 text-muted">Total Tiket</h6>
          <p class="h2 mb-0 text-dark">
            {{ $totalTickets }}
          </p>
        </div>

        {{-- TIKET TERBUKA --}}
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

{{-- TIKET TERBARU --}}
<div class="card mt-4 p-3">
  <h5 class="mb-3 text-dark">Daftar Tiket Terbaru</h5>

  <div class="table-responsive">
    <table class="table table-dark table-striped mb-0">
      <thead>
        <tr>
          <th>No Tiket</th>
          <th>Aktivitas</th>
          <th>Pemohon</th>
          <th>Status</th>
          <th>Dibuat</th>
        </tr>
      </thead>
      <tbody>
        @forelse($recentTickets as $t)
          <tr>
            <td>{{ $t->no_tiket }}</td>
            <td>
              <a href="{{ route('tickets.show', $t->id) }}" class="text-white text-decoration-none">
                {{ $t->aktivitas }}
              </a>
            </td>
            <td>{{ optional($t->user)->name ?? '—' }}</td>
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
            <td colspan="5" class="text-center text-muted">
              Tidak ada tiket
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection