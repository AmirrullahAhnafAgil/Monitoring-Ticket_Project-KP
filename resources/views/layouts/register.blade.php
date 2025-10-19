@extends('layouts.main')

@section('title', 'Register')

@section('content')
<div class="d-flex justify-content-center align-items-start" style="min-height:80vh; padding-top:60px;">
  <div class="card-custom p-5" style="max-width: 500px; width:100%;">
    <h2 class="mb-4">Register</h2>

    <form method="POST" action="{{ route('register.store') }}">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input id="name" type="text" name="name" 
               class="form-control @error('name') is-invalid @enderror" 
               value="{{ old('name') }}" required autofocus>
        @error('name')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" type="email" name="email" 
               class="form-control @error('email') is-invalid @enderror" 
               value="{{ old('email') }}" required>
        @error('email')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" name="password" 
               class="form-control @error('password') is-invalid @enderror" 
               required>
        @error('password')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" 
               class="form-control" required>
      </div>

      <button type="submit" class="btn-glow w-100">Register</button>
    </form>

    <div class="mt-3 text-center">
      <small>Sudah punya akun? <a href="{{ route('login') }}">Login</a></small>
    </div>
  </div>
</div>
@endsection