<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan daftar admin (khusus manager)
     */
    public function index()
    {
        $currentUser = Auth::user();

        if ($currentUser->role !== 'manager') {
            abort(403, 'Anda tidak punya akses.');
        }

        $admins = User::where('role', 'admin')->paginate(10);
        return view('manager.admins.index', compact('admins'));
    }

    /**
     * Form tambah admin baru
     */
    public function create()
    {
        if (Auth::user()->role !== 'manager') abort(403);
        return view('manager.admins.create');
    }

    /**
     * Simpan admin baru
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'manager') abort(403);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('manager.admins')->with('success', 'Admin baru berhasil ditambahkan.');
    }

    /**
     * Form edit admin
     */
    public function edit(User $user)
    {
        if (Auth::user()->role !== 'manager' || $user->role !== 'admin') abort(403);

        return view('manager.admins.edit', compact('user'));
    }

    /**
     * Update data admin
     */
    public function update(Request $request, User $user)
    {
        if (Auth::user()->role !== 'manager' || $user->role !== 'admin') abort(403);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password')
                ? Hash::make($request->password)
                : $user->password,
        ]);

        return redirect()->route('manager.admins')->with('success', 'Data admin berhasil diperbarui.');
    }

    /**
     * Hapus admin
     */
    public function destroy(User $user)
    {
        if (Auth::user()->role !== 'manager' || $user->role !== 'admin') abort(403);

        $user->delete();

        return redirect()->route('manager.admins')->with('success', 'Admin berhasil dihapus.');
    }
}