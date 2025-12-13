<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Sistem Monitoring Ticket')</title>

  <!-- AdminLTE + Bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <style>
    body {
      margin: 0;
      padding: 0;
      min-height: 100vh;
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #fff;
      overflow-x: hidden;
    }

    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: url("{{ asset('images/logo-bpn.png') }}") no-repeat center;
      background-size: 400px;
      opacity: 0.06;
      z-index: -1;
      pointer-events: none;
    }

    .wrapper {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      width: 100%;
    }

    /* ================= NAVBAR ================= */
    .main-header {
      background: #000 !important;
      z-index: 1030;

      /* 🔧 FIX KIRI KEPOTONG */
      width: 100vw;
      margin-left: 0 !important;
      left: 0;
    }

    /* ================= CONTENT ================= */
    .guest-wrapper {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 80px 15px 40px;
      width: 100%;
    }

    .guest-content {
      width: 100%;
      max-width: 1000px;
      text-align: center;
    }

    /* ================= CARD ================= */
    .card-custom {
      background: rgba(42,42,42,0.9);
      border-radius: 14px;
      padding: 42px;
      max-width: 820px;
      margin: 0 auto;
      box-shadow: 0 10px 30px rgba(0,0,0,0.6);
    }

    /* ================= BUTTON GLOW ================= */
    .btn-glow {
      background: #00ff88;
      color: #000;
      border: none;
      padding: 12px 30px;
      font-weight: bold;
      border-radius: 8px;
      transition: 0.3s;
      box-shadow: 0 0 10px #00ff88, 0 0 25px #00ff88;
    }

    .btn-glow:hover {
      transform: scale(1.05);
      box-shadow: 0 0 20px #00ff88, 0 0 45px #00ff88;
    }

    .btn-glow.secondary {
      background: #00c8ff;
      box-shadow: 0 0 10px #00c8ff, 0 0 25px #00c8ff;
    }

    .btn-glow.secondary:hover {
      box-shadow: 0 0 20px #00c8ff, 0 0 45px #00c8ff;
    }

    /* ================= SOCIAL BANNER ================= */
    .social-banner {
      background: rgba(0,0,0,0.28);
      border-top: 2px solid #00ff88;
      box-shadow: 0 -3px 15px rgba(0,255,136,0.2);
      padding: 26px 15px;
      text-align: center;

      /* 🔧 FIX KIRI KEPOTONG */
      width: 100vw;
      margin-left: 0 !important;
      left: 0;
    }

    .social-banner p {
      font-weight: 600;
      margin-bottom: 14px;
    }

    .social-banner a {
      color: #fff;
      margin: 0 14px;
      text-decoration: none;
      font-size: 15px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: 0.3s;
    }

    .social-banner a:hover {
      color: #00ff88;
      text-shadow: 0 0 8px #00ff88;
      transform: translateY(-2px);
    }

    /* ================= FOOTER ================= */
    .main-footer {
      background: #000;
      color: #ccc;

      /* 🔧 FIX KIRI KEPOTONG */
      width: 100vw;
      margin-left: 0 !important;
      left: 0;
    }
  </style>
</head>

<body>
<div class="wrapper">

  {{-- NAVBAR --}}
  <nav class="main-header navbar navbar-expand-md navbar-dark">
    <div class="container-fluid">
      <a href="{{ route('home') }}" class="navbar-brand">
        Monitoring Ticket
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
        <ul class="navbar-nav">
          <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
          <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
          <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About</a></li>
        </ul>
      </div>
    </div>
  </nav>

  {{-- CONTENT --}}
  <div class="guest-wrapper">
    <div class="guest-content">
      @yield('content')
    </div>
  </div>

  {{-- SOCIAL BANNER --}}
  <div class="social-banner">
    <p>Melayani, Profesional, Terpercaya</p>
    <div class="d-flex justify-content-center gap-4 flex-wrap">
      <a href="#"><i class="fa-brands fa-x-twitter"></i> kantahkotasmg</a>
      <a href="#"><i class="fa-brands fa-facebook-f"></i> Kantah Kota Semarang</a>
      <a href="#"><i class="fa-brands fa-youtube"></i> Kantah Kota Semarang</a>
      <a href="#"><i class="fa-brands fa-instagram"></i> KantahKotaSemarang</a>
      <a href="#"><i class="fa-brands fa-tiktok"></i> KantahKotaSemarang</a>
    </div>
  </div>

  {{-- FOOTER --}}
  <footer class="main-footer text-center py-3">
    <strong>&copy; {{ date('Y') }} - Kantor Pertanahan Kota Semarang</strong>
  </footer>

</div>

<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>