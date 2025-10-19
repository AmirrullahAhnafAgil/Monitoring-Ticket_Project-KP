@extends('layouts.main')

@section('title', 'Kelola Tiket - Admin')

@section('content')
<div class="card-custom mb-4">
  <h3 class="mb-3">Kelola Semua Tiket</h3>
  <p class="text-muted">Admin dapat memantau, mengedit, dan mengubah status tiket.</p>

  <table class="table table-dark table-striped align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>No Tiket</th>
        <th>Aktivitas</th>
        <th>Pemohon</th>
        <th>Status</th>
        <th>Dibuat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($tickets as $i => $ticket)
        <tr>
          <td>{{ $i+1 }}</td>
          <td>{{ $ticket->id }}</td>
          <td>{{ $ticket->aktivitas }}</td>
          <td>{{ $ticket->user->name ?? '—' }}</td>
          <td>
            <span class="badge bg-{{ $ticket->status == 'open' ? 'warning' : ($ticket->status == 'in_progress' ? 'info' : 'success') }}">
              {{ ucfirst($ticket->status) }}
            </span>
          </td>
          <td>{{ $ticket->created_at->format('d M Y H:i') }}</td>
          <td>
            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-sm btn-primary">Detail</a>
            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button type="submit" onclick="return confirm('Hapus tiket ini?')" class="btn btn-sm btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="7" class="text-center">Belum ada tiket.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection