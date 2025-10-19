@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
  <div class="col-md-8">
    <div class="card-custom p-5 text-center">
      <h1 class="mb-4 animate-title">Monitoring Ticket</h1>
      <p class="lead mb-4 animate-text">
        Aplikasi berbasis web ini untuk memantau dan mengelola tiket secara efisien, mudah digunakan,
        serta membantu proses administrasi lebih cepat dan terstruktur.
      </p>

      @guest
        <a href="{{ route('login') }}" class="btn-glow btn-lg mx-2">Login</a>
        <a href="{{ route('register') }}" 
           class="btn-glow btn-lg mx-2"
           style="background:#00bfff; box-shadow:0 0 10px #00bfff,0 0 20px #00bfff;">
          Register
        </a>
      @else
        <a href="{{ route('dashboard') }}" class="btn-glow btn-lg mx-2">Pergi ke Dashboard</a>
      @endguest
    </div>
  </div>
</div>

{{-- Animasi judul & teks --}}
<style>
  .animate-title, .animate-text {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeUp 1s ease forwards;
  }
  .animate-title { animation-delay: 0.2s; }
  .animate-text { animation-delay: 0.4s; }

  @keyframes fadeUp {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>
@endsection