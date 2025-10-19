<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user()->fresh(); // Ambil role terbaru dari DB
        $userRole = $user->role;

        // Pisahkan jika roles digabung dengan koma
        if (count($roles) === 1 && str_contains($roles[0], ',')) {
            $roles = array_map('trim', explode(',', $roles[0]));
        }

        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Jika tidak cocok, arahkan sesuai role-nya
        switch ($userRole) {
            case 'manager':
                return redirect()->route('dashboard.manager')->with('error', 'Akses dibatasi.');
            case 'admin':
                return redirect()->route('dashboard.admin')->with('error', 'Akses dibatasi.');
            case 'user':
                return redirect()->route('dashboard.user')->with('error', 'Akses dibatasi.');
            default:
                return redirect()->route('home')->with('error', 'Anda tidak memiliki akses.');
        }
    }
}