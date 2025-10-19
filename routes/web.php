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
// Home
// =======================
Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->fresh()->role;
        return match ($role) {
            'manager' => redirect()->route('dashboard.manager'),
            'admin'   => redirect()->route('dashboard.admin'),
            'user'    => redirect()->route('dashboard.user'),
            default   => redirect()->route('home'),
        };
    }
    return app(HomeController::class)->index();
})->name('home');

// =======================
// About Page (Public)
// =======================
Route::view('/about', 'layouts.about')->name('about');

// =======================
// Guest Routes
// =======================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
});

// =======================
// Authenticated Routes
// =======================
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard per role
    Route::get('/dashboard/admin', [DashboardController::class, 'adminDashboard'])
        ->name('dashboard.admin')->middleware(RoleMiddleware::class . ':admin');

    Route::get('/dashboard/manager', [DashboardController::class, 'managerDashboard'])
        ->name('dashboard.manager')->middleware(RoleMiddleware::class . ':manager');

    Route::get('/dashboard/user', [DashboardController::class, 'userDashboard'])
        ->name('dashboard.user')->middleware(RoleMiddleware::class . ':user');

    // Tickets CRUD
    Route::resource('tickets', TicketsController::class)
        ->middleware(RoleMiddleware::class . ':user,admin,manager');

    // Catatan CRUD (admin only)
    Route::resource('catatan', CatatanController::class)
        ->middleware(RoleMiddleware::class . ':admin');

    // Manager: Kelola Admin (CRUD)
    Route::middleware(RoleMiddleware::class . ':manager')->prefix('manager')->group(function () {
        Route::get('/admins', [UserController::class, 'index'])->name('manager.admins');
        Route::get('/admins/create', [UserController::class, 'create'])->name('manager.admins.create');
        Route::post('/admins', [UserController::class, 'store'])->name('manager.admins.store');
        Route::get('/admins/{user}/edit', [UserController::class, 'edit'])->name('manager.admins.edit');
        Route::put('/admins/{user}', [UserController::class, 'update'])->name('manager.admins.update');
        Route::delete('/admins/{user}', [UserController::class, 'destroy'])->name('manager.admins.destroy');
    });
});

// =======================
// Fallback
// =======================
Route::fallback(function () {
    return redirect()->route('home')->with('error', 'Halaman tidak ditemukan.');
});