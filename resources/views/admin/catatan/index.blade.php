@extends('layouts.main')

@section('title', 'Catatan Admin - Daftar Catatan')

@section('content')
<div class="card-custom mb-4">
  <h3 class="mb-3">Daftar Catatan Admin</h3>
  <p class="text-muted">Berikut adalah catatan yang dibuat Admin untuk menindaklanjuti tiket user.</p>

  <a href="{{ route('catatan.create') }}" class="btn-glow mb-3">+ Tambah Catatan</a>

  <table class="table table-dark table-striped align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>No Tiket</th>
        <th>Aktivitas</th>
        <th>User</th>
        <th>Catatan</th>
        <th>Dibuat Oleh</th>
        <th>Dibuat Pada</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($catatan as $i => $c)
        <tr>
          <td>{{ $catatan->firstItem() + $i }}</td>
          <td>{{ $c->ticket->no_tiket ?? $c->ticket->id }}</td>
          <td>{{ $c->ticket->aktivitas ?? '-' }}</td>
          <td>{{ $c->ticket->user->name ?? '—' }}</td>
          <td>{{ \Illuminate\Support\Str::limit($c->isi_catatan, 50) }}</td>
          <td>{{ $c->admin->name ?? '—' }}</td>
          <td>{{ $c->created_at->format('d M Y H:i') }}</td>
          <td>
            <a href="{{ route('catatan.show', $c->id) }}" class="btn btn-sm btn-info">Detail</a>
            <a href="{{ route('catatan.edit', $c->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('catatan.destroy', $c->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus catatan ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="8" class="text-center">Belum ada catatan</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-3">
    {{ $catatan->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection