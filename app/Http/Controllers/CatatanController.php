<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Catatan;
use App\Models\Tickets;

class CatatanController extends Controller
{
    /**
     * Tampilkan daftar catatan
     * Hanya admin yang bisa akses.
     * Isi index: daftar tiket user yang sudah direspon.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role !== 'admin') {
            abort(403);
        }

        // Ambil semua catatan beserta tiket dan admin pembuat catatan
        $catatan = Catatan::with(['ticket.user','admin'])
            ->latest()
            ->paginate(20);

        return view('admin.catatan.index', compact('catatan'));
    }

    /**
     * Form tambah catatan
     */
    public function create()
    {
        if (Auth::user()->role !== 'admin') abort(403);

        // Hanya tiket yang masih open/in_progress bisa ditambahkan catatan
        $tickets = Tickets::whereIn('status', ['open', 'in_progress'])->latest()->get();

        return view('admin.catatan.create', compact('tickets'));
    }

    /**
     * Simpan catatan baru
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'ticket_id'   => 'required|exists:tickets,id',
            'isi_catatan' => 'required|string',
        ]);

        Catatan::create([
            'ticket_id'   => $request->ticket_id,
            'isi_catatan' => $request->isi_catatan,
            'admin_id'    => Auth::id(),
        ]);

        return redirect()->route('catatan.index')->with('success', 'Catatan berhasil dibuat.');
    }

    /**
     * Detail catatan
     */
    public function show(Catatan $catatan)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $catatan->load(['ticket.user','admin']);
        return view('admin.catatan.show', compact('catatan'));
    }

    /**
     * Form edit catatan
     */
    public function edit(Catatan $catatan)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $tickets = Tickets::latest()->get();
        return view('admin.catatan.edit', compact('catatan','tickets'));
    }

    /**
     * Update catatan
     */
    public function update(Request $request, Catatan $catatan)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'ticket_id'   => 'required|exists:tickets,id',
            'isi_catatan' => 'required|string',
        ]);

        $catatan->update([
            'ticket_id'   => $request->ticket_id,
            'isi_catatan' => $request->isi_catatan,
        ]);

        return redirect()->route('catatan.index')->with('success', 'Catatan berhasil diperbarui.');
    }

    /**
     * Hapus catatan
     */
    public function destroy(Catatan $catatan)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $catatan->delete();

        return redirect()->route('catatan.index')->with('success', 'Catatan berhasil dihapus.');
    }
}