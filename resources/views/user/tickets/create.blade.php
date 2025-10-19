@extends('layouts.main')

@section('title', 'Buat Tiket')

@section('content')
<div class="card-custom">
  <h3 class="mb-3">Buat Tiket Baru</h3>

  <form action="{{ route('tickets.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="judul" class="form-label">Aktivitas</label>
      <input type="text" name="aktivitas" id="aktivitas" class="form-control" placeholder="Masukkan aktivitas" required>
    </div>

    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" placeholder="Jelaskan aktivitas atau masalah..." required></textarea>
    </div>

    <button type="submit" class="btn-glow">Simpan</button>
    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection