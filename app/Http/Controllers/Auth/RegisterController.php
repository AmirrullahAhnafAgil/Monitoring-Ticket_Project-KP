<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Tampilkan form register.
     */
    public function showRegisterForm()
    {
        // arahkan langsung ke resources/views/layouts/register.blade.php
        return view('auth.register');
    }

    /**
     * Proses registrasi user baru.
     */
    public function register(Request $request)
    {
        // validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // login otomatis setelah register
        Auth::login($user);

        // redirect ke home (resources/views/layouts/home.blade.php)
        return redirect('/home')->with('success', 'Registrasi berhasil! Anda sekarang sudah login.');
    }
}