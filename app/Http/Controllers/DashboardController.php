<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tickets;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->fresh(); // ambil role terbaru
        $totalTickets  = Tickets::count();
        $openTickets   = Tickets::where('status', 'open')->count();
        $recentTickets = Tickets::latest()->limit(5)->get();

        switch ($user->role) {
            case 'manager':
                return view('manager.dashboard', compact('user', 'totalTickets', 'openTickets', 'recentTickets'));
            case 'admin':
                return view('admin.dashboard', compact('user', 'totalTickets', 'openTickets', 'recentTickets'));
            case 'user':
                $myTickets = Tickets::where('user_id', $user->id)->latest()->limit(5)->get();
                return view('user.dashboard', compact('user', 'myTickets', 'totalTickets', 'openTickets'));
            default:
                return redirect()->route('home')->with('error', 'Role tidak dikenali.');
        }
    }

    public function adminDashboard()
    {
        $user = Auth::user()->fresh();
        $totalTickets = Tickets::count();
        $openTickets = Tickets::where('status', 'open')->count();
        $recentTickets = Tickets::latest()->limit(5)->get();

        return view('admin.dashboard', compact('user', 'totalTickets', 'openTickets', 'recentTickets'));
    }

    public function managerDashboard()
    {
        $user = Auth::user()->fresh();
        $totalTickets = Tickets::count();
        $openTickets = Tickets::where('status', 'open')->count();
        $recentTickets = Tickets::latest()->limit(5)->get();

        return view('manager.dashboard', compact('user', 'totalTickets', 'openTickets', 'recentTickets'));
    }

    public function userDashboard()
    {
        $user = Auth::user()->fresh();
        $myTickets = Tickets::where('user_id', $user->id)->latest()->limit(5)->get();

        return view('user.dashboard', compact('user', 'myTickets'));
    }
}