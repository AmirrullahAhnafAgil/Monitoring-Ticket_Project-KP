@extends('layouts.main')

@section('title', 'Login')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height:70vh;">
  <div class="card-custom p-5" style="max-width: 450px; width:100%;">
    <h2 class="mb-4">Login</h2>

    <form method="POST" action="{{ route('login.attempt') }}">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" type="email" name="email" 
               class="form-control @error('email') is-invalid @enderror" 
               value="{{ old('email') }}" required autofocus>
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

      <button type="submit" class="btn-glow w-100">Login</button>
    </form>

    <div class="mt-3 text-center">
      <small>Belum punya akun? <a href="{{ route('register') }}">Register</a></small>
    </div>
  </div>
</div>
@endsection