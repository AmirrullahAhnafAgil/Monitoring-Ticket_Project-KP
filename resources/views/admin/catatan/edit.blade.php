@extends('layouts.main')

@section('title', 'Edit Catatan - Admin')

@section('content')
<div class="card-custom">
  <h3 class="mb-3">Edit Catatan</h3>

  <form action="{{ route('catatan.update', $catatan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="ticket_id" class="form-label">Pilih Tiket</label>
      <select name="ticket_id" id="ticket_id" class="form-control" required>
        @foreach($tickets as $t)
          <option value="{{ $t->id }}" 
            {{ $catatan->ticket_id == $t->id ? 'selected' : '' }}>
            {{ $t->no_tiket ?? $t->id }} - {{ $t->aktivitas }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="isi_catatan" class="form-label">Isi Catatan</label>
      <textarea name="isi_catatan" id="isi_catatan" rows="5" class="form-control" required>{{ old('isi_catatan', $catatan->isi_catatan) }}</textarea>
    </div>

    <button type="submit" class="btn-glow">Update</button>
    <a href="{{ route('catatan.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection