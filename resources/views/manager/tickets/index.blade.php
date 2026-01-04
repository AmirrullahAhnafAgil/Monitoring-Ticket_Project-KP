@extends('layouts.main')

@section('title', 'Semua Tiket - Manager')

@section('content')
<div class="card-custom mb-4">
  <h3 class="mb-3">Daftar Semua Tiket</h3>
  <p class="text-muted">
    Sebagai Manager, Anda bisa memantau seluruh tiket yang dibuat user dan update yang dilakukan Admin.
  </p>

  <table class="table table-dark table-striped align-middle">
    <thead>
      <tr>
        <th>No</th>
        <th>No Tiket</th>
        <th>Aktivitas</th>
        <th>Pemohon</th>
        <th>Status</th>
        <th>Dibuat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($tickets as $i => $t)
        <tr>
          <td>{{ $i + 1 }}</td>

          {{-- 🔥 ID DIGANTI NO_TIKET --}}
          <td>{{ $t->no_tiket }}</td>

          <td>{{ $t->aktivitas }}</td>
          <td>{{ optional($t->user)->name ?? '—' }}</td>
          <td>
            <span class="badge 
              @if($t->status === 'open') bg-success 
              @elseif($t->status === 'in_progress') bg-warning text-dark
              @else bg-secondary @endif">
              {{ ucfirst(str_replace('_', ' ', $t->status)) }}
            </span>
          </td>
          <td>{{ $t->created_at->format('d M Y H:i') }}</td>
          <td>
            {{-- ROUTE TETAP PAKAI ID --}}
            <a href="{{ route('tickets.show', $t->id) }}" class="btn btn-sm btn-primary">
              Detail
            </a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" class="text-center text-muted">
            Belum ada tiket
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-3">
    {{ $tickets->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection