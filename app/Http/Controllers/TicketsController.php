<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tickets;
use App\Models\TicketsLogs;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf; // 🔥 TAMBAHAN PDF

class TicketsController extends Controller
{
    // ========================
    // LIST TIKET
    // ========================
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'user') {
            $tickets = Tickets::where('user_id', $user->id)
                ->latest()
                ->paginate(12);

            return view('user.tickets.index', compact('tickets'));
        }

        $tickets = Tickets::latest()->paginate(20);

        if ($user->role === 'admin') {
            return view('admin.tickets.index', compact('tickets'));
        }

        if ($user->role === 'manager') {
            return view('manager.tickets.index', compact('tickets'));
        }

        abort(403);
    }

    // ========================
    // CREATE TIKET
    // ========================
    public function create()
    {
        if (Auth::user()->role !== 'user') abort(403);
        return view('user.tickets.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'user') abort(403);

        $request->validate([
            'aktivitas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $ticket = Tickets::create([
            'user_id'   => Auth::id(),
            'aktivitas' => $request->aktivitas,
            'deskripsi' => $request->deskripsi,
            'status'    => 'open',
        ]);

        TicketsLogs::create([
            'ticket_id'  => $ticket->id,
            'user_id'    => Auth::id(),
            'aksi'       => 'Buat Tiket',
            'keterangan' => 'Tiket baru dibuat',
        ]);

        return redirect()->route('tickets.index')
            ->with('success', 'Tiket berhasil dibuat.');
    }

    // ========================
    // SHOW TIKET
    // ========================
    public function show(Tickets $ticket)
    {
        $ticket->load('logs.user');

        $user = Auth::user();

        if ($user->role === 'user' && $ticket->user_id !== $user->id) abort(403);

        if ($user->role === 'user') {
            return view('user.tickets.show', compact('ticket'));
        }

        if ($user->role === 'admin') {
            return view('admin.tickets.show', compact('ticket'));
        }

        if ($user->role === 'manager') {
            return view('manager.tickets.show', compact('ticket'));
        }

        abort(403);
    }

    // ========================
    // EDIT TIKET
    // ========================
    public function edit(Tickets $ticket)
    {
        $user = Auth::user();

        if ($user->role === 'user' && $ticket->user_id !== $user->id) abort(403);
        if ($user->role === 'user') return view('user.tickets.edit', compact('ticket'));
        if ($user->role === 'admin') return view('admin.tickets.edit', compact('ticket'));

        abort(403);
    }

    // ========================
    // UPDATE TIKET
    // ========================
    public function update(Request $request, Tickets $ticket)
    {
        $user = Auth::user();

        if ($user->role === 'manager') abort(403);
        if ($user->role === 'user' && $ticket->user_id !== $user->id) abort(403);

        // USER
        if ($user->role === 'user') {
            $request->validate([
                'aktivitas' => 'required|string|max:255',
                'deskripsi' => 'required|string',
            ]);

            $ticket->update([
                'aktivitas' => $request->aktivitas,
                'deskripsi' => $request->deskripsi,
            ]);

            TicketsLogs::create([
                'ticket_id'  => $ticket->id,
                'user_id'    => $user->id,
                'aksi'       => 'Update Tiket',
                'keterangan' => 'User memperbarui tiket',
            ]);

            return redirect()->route('tickets.index')
                ->with('success', 'Tiket berhasil diperbarui.');
        }

        // ADMIN
        $request->validate([
            'aktivitas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status'    => ['required', Rule::in(['open', 'in_progress', 'closed'])],
        ]);

        $oldStatus = $ticket->status;

        $ticket->update($request->only(['aktivitas', 'deskripsi', 'status']));

        TicketsLogs::create([
            'ticket_id'  => $ticket->id,
            'user_id'    => $user->id,
            'aksi'       => 'Update Tiket',
            'keterangan' => "Status: {$oldStatus} → {$request->status}",
        ]);

        return redirect()->route('tickets.index')
            ->with('success', 'Tiket berhasil diperbarui.');
    }

    // ========================
    // DELETE TIKET
    // ========================
    public function destroy(Tickets $ticket)
    {
        $user = Auth::user();

        if ($user->role === 'manager') abort(403);
        if ($user->role === 'user' && $ticket->user_id !== $user->id) abort(403);

        TicketsLogs::create([
            'ticket_id'  => $ticket->id,
            'user_id'    => $user->id,
            'aksi'       => 'Hapus Tiket',
            'keterangan' => 'Tiket dihapus',
        ]);

        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Tiket berhasil dihapus.');
    }

    // ========================
    // 🔥 EXPORT PDF (MANAGER ONLY)
    // ========================
    public function exportPdf()
    {
        if (Auth::user()->role !== 'manager') abort(403);

        $tickets = Tickets::with('user')
            ->latest()
            ->get();

        $pdf = Pdf::loadView('manager.tickets.pdf', compact('tickets'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-tiket-manager.pdf');
    }
}