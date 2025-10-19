<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Coba login
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user()->fresh(); // Ambil role terbaru dari database

            // Regenerasi session
            $request->session()->regenerate();

            // Redirect sesuai role
            switch ($user->role) {
                case 'manager':
                    return redirect()->route('dashboard.manager')
                        ->with('success', 'Selamat datang kembali, Manager!');
                case 'admin':
                    return redirect()->route('dashboard.admin')
                        ->with('success', 'Selamat datang, Admin!');
                case 'user':
                    return redirect()->route('dashboard.user')
                        ->with('success', 'Selamat datang, Pengguna!');
                default:
                    Auth::logout();
                    return redirect()->route('login')
                        ->with('error', 'Role tidak dikenali, hubungi administrator.');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout.');
    }
}