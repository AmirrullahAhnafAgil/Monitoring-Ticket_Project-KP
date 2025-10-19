@extends('layouts.main')

@section('title', 'Edit Tiket')

@section('content')
<div class="card-custom">
  <h3 class="mb-3">Edit Tiket</h3>

  <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="aktivitas" class="form-label">Aktivitas</label>
      <input type="text" name="aktivitas" id="aktivitas" 
             class="form-control" value="{{ $ticket->aktivitas }}" required>
    </div>

    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea name="deskripsi" id="deskripsi" rows="4" 
                class="form-control" required>{{ $ticket->deskripsi }}</textarea>
    </div>

    {{-- User tidak bisa ubah status, jadi field status dihapus --}}

    <button type="submit" class="btn-glow">Update</button>
    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection