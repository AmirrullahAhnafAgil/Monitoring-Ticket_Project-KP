@extends('layouts.main')

@section('title', 'Tambah Admin')

@section('content')
<div class="card-custom">
  <h3 class="mb-3">Tambah Admin Baru</h3>

  <form action="{{ route('manager.admins.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
    </div>

    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Konfirmasi Password</label>
      <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn-glow">Simpan</button>
    <a href="{{ route('manager.admins') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection