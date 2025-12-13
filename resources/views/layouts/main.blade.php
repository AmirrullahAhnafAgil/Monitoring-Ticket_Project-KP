<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Dashboard - Monitoring Ticket')</title>

  <!-- AdminLTE -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <style>
    /* ================= GLOBAL ================= */
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #fff;
      overflow: hidden; /* 🔥 BODY TIDAK BOLEH SCROLL */
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
      height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* ================= NAVBAR ================= */
    .main-header {
      background: #000 !important;
      color: #ccc;
      z-index: 1030;
      width: 100vw;
      margin-left: 0 !important;
      left: 0;
    }

    /* ================= FOOTER ================= */
    .main-footer {
      background: #000 !important;
      color: #ccc;
      width: 100vw;
      margin-left: 0 !important;
      left: 0;
    }

    /* ================= DASHBOARD LAYOUT ================= */
    .auth-wrapper {
      flex: 1;
      display: flex;
      height: calc(100vh - 56px - 56px);
      overflow: hidden; /* 🔥 wrapper tidak scroll */
    }

    /* ================= SIDEBAR ================= */
    .app-sidebar {
      position: fixed;
      top: 56px;
      left: 0;
      width: 250px;
      height: calc(100vh - 112px);
      background-color: #1c1c1c;
      border-right: 1px solid #2c2c2c;
      display: flex;
      flex-direction: column;
      z-index: 1040;
    }

    /* ================= MAIN CONTENT ================= */
    .app-main {
      margin-left: 250px;
      flex: 1;
      height: calc(100vh - 112px);
      overflow-y: auto; /* ✅ SCROLL DI SINI */
      overflow-x: hidden;
    }

    .content-area {
      padding: 24px;
    }

    .content-inner {
      max-width: 1100px;
      margin: 0 auto;
    }

    /* ================= RESPONSIVE ================= */
    @media (max-width: 991.98px) {
      .app-sidebar {
        display: none;
      }
      .app-main {
        margin-left: 0;
      }
    }
  </style>
</head>

<body class="hold-transition">
<div class="wrapper">

@auth
  {{-- NAVBAR --}}
  <nav class="main-header navbar navbar-expand-md navbar-dark shadow-sm">
    <div class="container-fluid">
      <span class="navbar-brand">Monitoring Ticket</span>

      <div class="ms-auto dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
          <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <form action="{{ route('logout') }}" method="POST" class="px-3">
              @csrf
              <button type="submit" class="btn btn-danger w-100">Logout</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  {{-- DASHBOARD --}}
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

  {{-- FOOTER --}}
  <footer class="main-footer text-center py-3">
    <strong>&copy; {{ date('Y') }} - Kantor Pertanahan Kota Semarang</strong>
  </footer>
@endauth

</div>

<!-- JS -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>