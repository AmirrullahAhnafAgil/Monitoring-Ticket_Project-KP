@extends('layouts.main')

@section('title', 'Tiket Saya')

@section('content')
<div class="card-custom mb-4">
  <h3 class="mb-3">Daftar Tiket Saya</h3>
  <a href="{{ route('tickets.create') }}" class="btn btn-light mb-3">
    Buat Tiket Baru
  </a>

  <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>No Tiket</th>
        <th>Aktivitas</th>
        <th>Status</th>
        <th>Dibuat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($tickets as $i => $ticket)
        <tr>
          <td>{{ $i + 1 }}</td>
          {{-- 🔥 SAMA SEPERTI DASHBOARD --}}
          <td>{{ $ticket->no_tiket }}</td>
          <td>{{ $ticket->aktivitas }}</td>
          <td>
            <span class="badge bg-{{ 
              $ticket->status === 'open' 
                ? 'warning text-dark' 
                : ($ticket->status === 'in_progress' 
                    ? 'info' 
                    : 'success') 
            }}">
              {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
            </span>
          </td>
          <td>{{ $ticket->created_at->format('d M Y H:i') }}</td>
          <td>
            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-sm btn-primary">
              Detail
            </a>
            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-warning">
              Edit
            </a>
            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit"
                      onclick="return confirm('Hapus tiket ini?')"
                      class="btn btn-sm btn-danger">
                Hapus
              </button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center text-muted">
            Belum ada tiket.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection