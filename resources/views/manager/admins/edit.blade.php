@extends('layouts.main')

@section('title', 'Edit Admin')

@section('content')
<div class="card-custom">
  <h3 class="mb-3">Edit Admin</h3>

  <form action="{{ route('manager.admins.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Password Baru (Opsional)</label>
      <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Konfirmasi Password Baru</label>
      <input type="password" name="password_confirmation" class="form-control">
    </div>

    <button type="submit" class="btn-glow">Perbarui</button>
    <a href="{{ route('manager.admins') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection