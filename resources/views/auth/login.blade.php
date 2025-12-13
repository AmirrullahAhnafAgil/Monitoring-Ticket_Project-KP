@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card-custom p-5">
      <h2 class="text-center mb-4">Silakan Login</h2>
      
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group mb-3">
          <label for="email" class="form-label">Email</label>
          <input id="email" type="email" name="email" 
                 class="form-control @error('email') is-invalid @enderror" 
                 placeholder="Masukkan email anda"
                 required autofocus>
          @error('email')
            <span class="invalid-feedback d-block">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group mb-4">
          <label for="password" class="form-label">Password</label>
          <input id="password" type="password" name="password" 
                 class="form-control @error('password') is-invalid @enderror" 
                 placeholder="Masukkan password"
                 required>
          @error('password')
            <span class="invalid-feedback d-block">{{ $message }}</span>
          @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center">
          <button type="submit" class="btn-glow btn-lg">
            <i></i> Login
          </button>
          <a href="{{ route('register') }}" class="text-decoration-none">
            Belum punya akun?
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection