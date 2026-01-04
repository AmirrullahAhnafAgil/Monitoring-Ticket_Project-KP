<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\CatatanController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;

// =======================
// HOME (GUEST ONLY)
// =======================
Route::get('/', [HomeController::class, 'index'])
    ->middleware('guest')
    ->name('home');

// =======================
// ABOUT (GUEST ONLY)
// =======================
Route::view('/about', 'about')
    ->middleware('guest')
    ->name('about');

// =======================
// AUTH (LOGIN & REGISTER)
// =======================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');

    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
});

// =======================
// AUTHENTICATED USERS
// =======================
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Redirect root after login (SAFETY)
    Route::get('/dashboard', function () {
        return match (Auth::user()->role) {
            'manager' => redirect()->route('dashboard.manager'),
            'admin'   => redirect()->route('dashboard.admin'),
            'user'    => redirect()->route('dashboard.user'),
            default   => redirect()->route('home'),
        };
    })->name('dashboard');

    // =======================
    // DASHBOARD PER ROLE
    // =======================
    Route::get('/dashboard/admin', [DashboardController::class, 'adminDashboard'])
        ->name('dashboard.admin')
        ->middleware(RoleMiddleware::class . ':admin');

    Route::get('/dashboard/manager', [DashboardController::class, 'managerDashboard'])
        ->name('dashboard.manager')
        ->middleware(RoleMiddleware::class . ':manager');

    Route::get('/dashboard/user', [DashboardController::class, 'userDashboard'])
        ->name('dashboard.user')
        ->middleware(RoleMiddleware::class . ':user');

    // =======================
    // TICKETS (SEMUA ROLE)
    // =======================
    Route::resource('tickets', TicketsController::class)
        ->middleware(RoleMiddleware::class . ':user,admin,manager');

    // =======================
    // 🔥 DOWNLOAD PDF (MANAGER ONLY)
    // =======================
    Route::get('/manager/tickets/pdf', [TicketsController::class, 'exportPdf'])
        ->name('manager.tickets.pdf')
        ->middleware(RoleMiddleware::class . ':manager');

    // =======================
    // CATATAN (ADMIN ONLY)
    // =======================
    Route::resource('catatan', CatatanController::class)
        ->middleware(RoleMiddleware::class . ':admin');

    // =======================
    // MANAGER - KELOLA ADMIN
    // =======================
    Route::middleware(RoleMiddleware::class . ':manager')
        ->prefix('manager')
        ->group(function () {
            Route::resource('admins', UserController::class)->names([
                'index'   => 'manager.admins',
                'create'  => 'manager.admins.create',
                'store'   => 'manager.admins.store',
                'edit'    => 'manager.admins.edit',
                'update'  => 'manager.admins.update',
                'destroy' => 'manager.admins.destroy',
            ]);
        });
});

// =======================
// FALLBACK
// =======================
Route::fallback(function () {
    return redirect()->route('home');
});