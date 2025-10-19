@extends('layouts.main')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card-custom p-5">
      <h2 class="text-center mb-4">Silakan Buat Akun Terlebih Dahulu</h2>
      
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group mb-3">
          <label for="name" class="form-label">Nama</label>
          <input id="name" type="text" name="name" 
                 class="form-control @error('name') is-invalid @enderror" 
                 placeholder="Masukkan nama lengkap"
                 required autofocus>
          @error('name')
            <span class="invalid-feedback d-block">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group mb-3">
          <label for="email" class="form-label">Email</label>
          <input id="email" type="email" name="email" 
                 class="form-control @error('email') is-invalid @enderror" 
                 placeholder="Masukkan email anda"
                 required>
          @error('email')
            <span class="invalid-feedback d-block">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group mb-3">
          <label for="password" class="form-label">Password</label>
          <input id="password" type="password" name="password" 
                 class="form-control @error('password') is-invalid @enderror" 
                 placeholder="Masukkan password"
                 required>
          @error('password')
            <span class="invalid-feedback d-block">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group mb-4">
          <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
          <input id="password_confirmation" type="password" name="password_confirmation" 
                 class="form-control" placeholder="Ulangi password" required>
        </div>

        <div class="d-flex justify-content-between align-items-center">
          <button type="submit" class="btn-glow btn-lg">
            <i></i> Register
          </button>
          <a href="{{ route('login') }}" class="text-decoration-none">
            Sudah punya akun?
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection