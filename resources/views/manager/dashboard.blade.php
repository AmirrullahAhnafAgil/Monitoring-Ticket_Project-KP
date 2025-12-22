@extends('layouts.main')

@section('title', 'Dashboard - Manager')

@section('content')
<div class="card-custom mb-4">
  <h3 class="mb-1">Halo, {{ $user->name }} (Manager)</h3>
  <p class="text-muted mb-3">Pantau ringkasan tiket harian. Gunakan tombol di bawah untuk monitoring cepat.</p>

  <div class="d-flex flex-wrap gap-2">
    <a href="{{ route('tickets.index') }}" class="btn btn-light">Lihat Semua Tiket</a>
  </div>
</div>

<div class="row g-3">
  <div class="col-md-6">
    <div class="card p-3">
      <h6>Total Tiket</h6>
      <p class="h2 mb-0">{{ $totalTickets ?? '--' }}</p>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card p-3">
      <h6>Tiket Terbuka</h6>
      <p class="h2 mb-0 text-warning">{{ $openTickets ?? '--' }}</p>
    </div>
  </div>
</div>

{{-- Recent tickets --}}
<div class="card mt-4 p-3">
  <h5>Daftar Tiket Terbaru</h5>
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
          <td><a href="{{ route('tickets.show', $t->id) }}" class="text-white">{{ $t->aktivitas }}</a></td>
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
        <tr><td colspan="5" class="text-center">Tidak ada tiket</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection