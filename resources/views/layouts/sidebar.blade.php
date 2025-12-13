<div class="d-flex flex-column text-white h-100">

  {{-- PROFIL --}}
  <div class="sidebar-header text-center py-4 border-bottom border-secondary">
    <i class="fas fa-user-circle fa-4x mb-2 text-info"></i>
    <h5 class="mb-0 fw-bold">{{ Auth::user()->name }}</h5>
    <small class="text-muted">({{ ucfirst(Auth::user()->role) }})</small>
  </div>

  {{-- MENU --}}
  <div class="sidebar-menu flex-grow-1 px-2 mt-3 overflow-auto">
    <ul class="nav nav-pills flex-column gap-1">

      @php
        $user = Auth::user();
        $dashboardRoute = match($user->role) {
          'manager' => route('dashboard.manager'),
          'admin'   => route('dashboard.admin'),
          'user'    => route('dashboard.user'),
          default   => route('home')
        };
      @endphp

      <li class="nav-item">
        <a href="{{ $dashboardRoute }}"
           class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
          <i class="fas fa-home me-2"></i> Dashboard
        </a>
      </li>

      @if($user->role === 'user')
        <li class="nav-item">
          <a href="{{ route('tickets.index') }}"
             class="nav-link {{ request()->is('tickets*') ? 'active' : '' }}">
            <i class="fas fa-ticket-alt me-2"></i> Tiket Saya
          </a>
        </li>
      @endif

      @if($user->role === 'admin')
        <li class="nav-item">
          <a href="{{ route('tickets.index') }}"
             class="nav-link {{ request()->is('tickets*') ? 'active' : '' }}">
            <i class="fas fa-tasks me-2"></i> Kelola Tiket
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('catatan.index') }}"
             class="nav-link {{ request()->is('catatan*') ? 'active' : '' }}">
            <i class="fas fa-sticky-note me-2"></i> Catatan Admin
          </a>
        </li>
      @endif

      @if($user->role === 'manager')
        <li class="nav-item">
          <a href="{{ route('tickets.index') }}"
             class="nav-link {{ request()->is('tickets*') ? 'active' : '' }}">
            <i class="fas fa-clipboard-list me-2"></i> Semua Tiket
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('manager.admins') }}"
             class="nav-link {{ request()->is('manager/admins*') ? 'active' : '' }}">
            <i class="fas fa-user-shield me-2"></i> Kelola Admin
          </a>
        </li>
      @endif

    </ul>
  </div>

  {{-- LOGOUT --}}
  <div class="p-3 border-top border-secondary">
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="btn btn-danger w-100">
        <i class="fas fa-sign-out-alt me-2"></i> Logout
      </button>
    </form>
  </div>

</div>