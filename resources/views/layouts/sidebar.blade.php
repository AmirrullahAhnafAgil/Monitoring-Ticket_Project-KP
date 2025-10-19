<div class="app-sidebar d-flex flex-column text-white shadow-lg">

  {{-- Profil User --}}
  <div class="sidebar-header text-center py-4 border-bottom border-secondary">
      <i class="fas fa-user-circle fa-4x mb-2 text-info"></i>
      <h5 class="mb-0 fw-bold">{{ Auth::user()->name }}</h5>
      <small class="text-muted">({{ ucfirst(Auth::user()->role) }})</small>
  </div>

  {{-- Menu Navigasi --}}
  <div class="sidebar-menu flex-grow-1 mt-3">
    <ul class="nav nav-pills flex-column px-2">
        @php
            $user = Auth::user();
            $dashboardRoute = match($user->role) {
                'manager' => route('dashboard.manager'),
                'admin'   => route('dashboard.admin'),
                'user'    => route('dashboard.user'),
                default   => route('home')
            };
        @endphp

        {{-- Dashboard --}}
        <li class="nav-item mb-2">
            <a href="{{ $dashboardRoute }}" 
               class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
               <i class="fas fa-home me-2"></i> Dashboard {{ ucfirst($user->role) }}
            </a>
        </li>

        {{-- Menu untuk User --}}
        @if($user->role === 'user')
            <li class="nav-item mb-2">
                <a href="{{ route('tickets.index') }}" 
                   class="nav-link {{ request()->is('tickets*') ? 'active' : '' }}">
                   <i class="fas fa-ticket-alt me-2"></i> Tiket Saya
                </a>
            </li>
        @endif

        {{-- Menu untuk Admin --}}
        @if($user->role === 'admin')
            <li class="nav-item mb-2">
                <a href="{{ route('tickets.index') }}" 
                   class="nav-link {{ request()->is('tickets*') ? 'active' : '' }}">
                   <i class="fas fa-tasks me-2"></i> Kelola Tiket
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('catatan.index') }}" 
                   class="nav-link {{ request()->is('catatan*') ? 'active' : '' }}">
                   <i class="fas fa-sticky-note me-2"></i> Catatan Admin
                </a>
            </li>
        @endif

        {{-- Menu untuk Manager --}}
        @if($user->role === 'manager')
            <li class="nav-item mb-2">
                <a href="{{ route('tickets.index') }}" 
                   class="nav-link {{ request()->is('tickets*') ? 'active' : '' }}">
                   <i class="fas fa-clipboard-list me-2"></i> Semua Tiket
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('manager.admins') }}" 
                   class="nav-link {{ request()->is('manager/admins*') ? 'active' : '' }}">
                   <i class="fas fa-user-shield me-2"></i> Kelola Admin
                </a>
            </li>
        @endif
    </ul>
  </div>

  {{-- Logout --}}
  <div class="sidebar-footer py-3 border-top border-secondary text-center">
      <form action="{{ route('logout') }}" method="POST" class="px-2">
          @csrf
          <button type="submit" class="btn btn-danger w-100 d-flex align-items-center justify-content-center">
              <i class="fas fa-sign-out-alt me-2"></i> Logout
          </button>
      </form>
  </div>
</div>

{{-- ✅ CSS Fix Sidebar agar tidak menutupi header/footer --}}
<style>
  .app-sidebar {
      position: fixed;
      top: 56px; /* tinggi header */
      left: 0;
      width: 250px;
      height: calc(100vh - 112px); /* 56px header + 56px footer */
      background-color: #1c1c1c !important;
      border-right: 1px solid #2c2c2c;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      z-index: 1040;
  }

  /* Scroll hanya di menu, bukan di header/footer */
  .sidebar-menu {
      overflow-y: auto;
      overflow-x: hidden;
      flex: 1;
      scrollbar-width: thin;
      scrollbar-color: #444 #1c1c1c;
  }

  .sidebar-menu::-webkit-scrollbar {
      width: 6px;
  }
  .sidebar-menu::-webkit-scrollbar-thumb {
      background-color: #444;
      border-radius: 3px;
  }

  /* Tampilan link menu */
  .sidebar-menu .nav-link {
      color: #adb5bd;
      border-radius: 6px;
      padding: 10px 14px;
      transition: all 0.25s ease-in-out;
  }
  .sidebar-menu .nav-link:hover {
      background-color: #00ff88;
      color: #000 !important;
      box-shadow: 0 0 10px #00ff88;
      transform: translateX(3px);
  }
  .sidebar-menu .nav-link.active {
      background-color: #00ff88 !important;
      color: #000 !important;
      font-weight: bold;
      box-shadow: 0 0 12px #00ff88;
  }

  .sidebar-header, .sidebar-footer {
      background: rgba(255, 255, 255, 0.03);
  }

  /* Konten utama sejajar sidebar */
  .app-main {
      margin-left: 250px;
      padding: 24px;
      min-height: calc(100vh - 112px);
  }

  /* Responsif */
  @media (max-width: 991.98px) {
      .app-sidebar {
          display: none;
      }
      .app-main {
          margin-left: 0;
      }
  }
</style>