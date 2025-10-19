@extends('layouts.main')

@section('title', 'Tambah Catatan - Admin')

@section('content')
<div class="card-custom">
  <h3 class="mb-3">Tambah Catatan</h3>

  <form action="{{ route('catatan.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label for="ticket_id" class="form-label">Pilih Tiket</label>
      <select name="ticket_id" id="ticket_id" class="form-control" required>
        <option value="">-- Pilih Tiket --</option>
        @foreach($tickets as $t)
          <option value="{{ $t->id }}">
            {{ $t->no_tiket ?? $t->id }} - {{ $t->aktivitas }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="isi_catatan" class="form-label">Isi Catatan</label>
      <textarea name="isi_catatan" id="isi_catatan" rows="5" class="form-control" required>{{ old('isi_catatan') }}</textarea>
    </div>

    <button type="submit" class="btn-glow">Simpan</button>
    <a href="{{ route('catatan.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection