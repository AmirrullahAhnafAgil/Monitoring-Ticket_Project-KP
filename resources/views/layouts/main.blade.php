<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Sistem Monitoring Ticket')</title>

  <!-- Bootstrap + AdminLTE -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

  <!-- Tambahan untuk ikon terbaru (Font Awesome 6) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <style>
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364) fixed;
      color: #fff;
      font-family: 'Arial', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      overflow-x: hidden;
    }

    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: url("{{ asset('images/logo-bpn.png') }}") no-repeat center center;
      background-size: 400px;
      opacity: 0.06;
      z-index: -1;
    }

    .wrapper {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .main-header, .main-footer {
      background-color: #000 !important;
      color: #ccc;
      z-index: 1030;
    }

    /* Guest wrapper (Home/Login/Register) */
    .guest-wrapper {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      text-align: center;
      padding: 60px 15px 0;
      width: 100%;
    }

    /* Konten utama guest */
    .guest-content {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      width: 100%;
      max-width: 1000px;
    }

    /* Social Banner pas di atas footer */
    .guest-social-wrapper {
      margin-top: auto;
      width: 100%;
    }

    .social-banner {
      text-align: center;
      padding: 25px 0;
      background: rgba(0, 0, 0, 0.25);
      border-top: 2px solid #00ff88;
      box-shadow: 0 -3px 15px rgba(0,255,136,0.2);
    }

    .social-banner a {
      color: #fff;
      margin: 0 15px;
      font-size: 16px;
      text-decoration: none;
      transition: 0.3s;
    }

    .social-banner a:hover {
      color: #00ff88;
      text-shadow: 0 0 10px #00ff88;
    }

    /* Auth wrapper (Dashboard) */
    .auth-wrapper {
      flex: 1;
      display: flex;
      min-height: calc(100vh - 56px - 56px);
      position: relative;
      overflow: hidden;
    }

    /* Sidebar */
    .app-sidebar {
      width: 250px;
      background: #1c1c1c;
      position: fixed;
      top: 56px;
      bottom: 56px;
      left: 0;
      overflow-y: auto;
      border-right: 1px solid #2c2c2c;
      z-index: 1020;
      transition: all 0.3s ease-in-out;
    }

    /* Main Content (Dashboard) */
    .app-main {
      flex: 1;
      margin-left: 250px;
      display: flex;
      flex-direction: column;
      height: calc(100vh - 112px);
      overflow-y: auto;
      scroll-behavior: smooth;
      position: relative;
      background: transparent;
    }

    /* Hindari scrollbar ganda di dashboard */
    body.auth-active {
      overflow: hidden;
    }

    .content-area {
      flex: 1;
      padding: 24px;
    }

    .content-inner {
      max-width: 1100px;
      margin: 0 auto;
    }

    /* Card */
    .card-custom {
      background: rgba(42,42,42,0.9);
      border-radius: 12px;
      padding: 40px;
      max-width: 800px;
      width: 100%;
      margin: 0 auto 30px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.6);
      color: #fff;
    }

    /* Button glow */
    .btn-glow {
      background: #00ff88;
      color: #000;
      border: none;
      padding: 10px 25px;
      font-weight: bold;
      border-radius: 6px;
      transition: 0.3s;
      box-shadow: 0 0 10px #00ff88, 0 0 20px #00ff88;
    }

    .btn-glow:hover {
      box-shadow: 0 0 20px #00ff88, 0 0 40px #00ff88;
      transform: scale(1.05);
    }

    /* Flash message modern */
    .alert-custom {
      max-width: 700px;
      margin: 20px auto;
      text-align: center;
      border-radius: 8px;
      font-weight: 600;
      animation: fadeInDown 0.5s ease-in-out;
    }

    .alert-success {
      background: rgba(0,255,136,0.15);
      color: #00ff88;
      border: 1px solid #00ff88;
      box-shadow: 0 0 10px rgba(0,255,136,0.4);
    }

    .alert-danger {
      background: rgba(255,0,64,0.15);
      color: #ff4060;
      border: 1px solid #ff4060;
      box-shadow: 0 0 10px rgba(255,0,64,0.4);
    }

    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .navbar-nav .nav-link:hover {
      color: #00ff88 !important;
    }

    @media (max-width: 991.98px) {
      .app-sidebar { display: none; }
      .app-main { margin-left: 0; }
      .card-custom { padding: 25px; }
    }
  </style>
</head>

<body class="hold-transition layout-top-nav @auth auth-active @endauth">
<div class="wrapper">

  {{-- NAVBAR --}}
  <nav class="main-header navbar navbar-expand-md navbar-dark shadow-sm">
    <div class="container-fluid">
      <a href="{{ route('home') }}" class="navbar-brand">
        <span class="brand-text font-weight-light">Monitoring Ticket</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
        <ul class="navbar-nav align-items-center">
          @guest
            <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
            <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About</a></li>
          @else
            <li class="nav-item dropdown">
              <a id="userDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  @php
                    $user = Auth::user();
                    $route = match($user->role) {
                      'manager' => route('dashboard.manager'),
                      'admin'   => route('dashboard.admin'),
                      'user'    => route('dashboard.user'),
                      default   => route('home')
                    };
                  @endphp
                  <a class="dropdown-item" href="{{ $route }}">Dashboard</a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="{{ route('logout') }}" method="POST" class="px-3">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Logout</button>
                  </form>
                </li>
              </ul>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  {{-- FLASH MESSAGE --}}
  @if(session('success'))
    <div class="alert alert-success alert-custom">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger alert-custom">{{ session('error') }}</div>
  @endif

  {{-- GUEST (Home, Login, Register) --}}
  @guest
    <div class="guest-wrapper">
      <div class="guest-content">
        @yield('content')
      </div>
      <div class="guest-social-wrapper">
        <div class="social-banner">
          <p>Melayani, Profesional, Terpercaya</p>
          <div class="d-flex justify-content-center gap-4 flex-wrap">
            <a href="https://x.com/kantahkabsmg?s=21"><i class="fa-brands fa-x-twitter fa-lg"></i> kantahkotasmg</a>
            <a href="https://www.facebook.com/share/17RWYydVJc/?mibextid=wwXIfr"><i class="fa-brands fa-facebook-f fa-lg"></i> Kantah Kota Semarang</a>
            <a href="https://youtube.com/@kantorpertanahankotasemarang?si=WkC4p4iXq1OPpL0P"><i class="fa-brands fa-youtube fa-lg"></i> Kantah Kota Semarang</a>
            <a href="https://www.instagram.com/kantahkotasemarang?igsh=MXBvODVnNnkxeHJ2YQ=="><i class="fa-brands fa-instagram fa-lg"></i> KantahKotaSemarang</a>
            <a href="https://www.tiktok.com/@kantahkotasemarang1?_t=ZS-90g19nlGWUy&_r=1"><i class="fa-brands fa-tiktok fa-lg"></i> KantahKotaSemarang</a>
          </div>
        </div>
      </div>
    </div>
  @endguest

  {{-- AUTH (Dashboard + Sidebar) --}}
  @auth
    <div class="auth-wrapper">
      <aside class="app-sidebar">
        @include('layouts.sidebar')
      </aside>

      <main class="app-main">
        <div class="content-area">
          <div class="content-inner">
            @yield('content')
          </div>
        </div>
      </main>
    </div>
  @endauth

  {{-- FOOTER --}}
  <footer class="main-footer text-center py-3 mt-auto">
    <strong>&copy; {{ date('Y') }} - Kantor Pertanahan Kota Semarang</strong>
  </footer>

</div>

<!-- JS -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>