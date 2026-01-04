<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tickets;

class DashboardController extends Controller
{
    public function managerDashboard()
    {
        $user = Auth::user();

        $totalTickets  = Tickets::count();
        $openTickets   = Tickets::where('status', 'open')->count();
        $recentTickets = Tickets::latest()->limit(5)->get();

        return view('manager.dashboard', compact(
            'user',
            'totalTickets',
            'openTickets',
            'recentTickets'
        ));
    }

    public function adminDashboard()
    {
        $user = Auth::user();

        $totalTickets  = Tickets::count();
        $openTickets   = Tickets::where('status', 'open')->count();
        $recentTickets = Tickets::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'user',
            'totalTickets',
            'openTickets',
            'recentTickets'
        ));
    }

    public function userDashboard()
    {
        $user = Auth::user();

        $myTickets = Tickets::where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        $totalTickets = Tickets::where('user_id', $user->id)->count();
        $openTickets  = Tickets::where('user_id', $user->id)
            ->where('status', 'open')
            ->count();

        return view('user.dashboard', compact(
            'user',
            'myTickets',
            'totalTickets',
            'openTickets'
        ));
    }
}