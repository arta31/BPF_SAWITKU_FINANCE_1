<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventMitraController extends Controller
{
    // DAFTAR EVENT SAYA (UPDATE: Sudah ada Filter & Search)
    public function index(Request $request)
    {
        // 1. Tentukan kolom yang boleh difilter & dicari
        $filterableColumns = ['status'];
        $searchableColumns = ['nama_event', 'lokasi'];

        // 2. Ambil event milik user yang sedang login + Terapkan Filter
        $events = Event::where('user_id', Auth::id())
            ->filter($request, $filterableColumns, $searchableColumns) // Memanggil scopeFilter dari Model
            ->latest()
            ->paginate(5) // Menampilkan 5 data per halaman
            ->withQueryString(); // Agar filter tidak hilang saat pindah halaman
        
        return view('pages.mitra.events.index', compact('events'));
    }

    // FORM TAMBAH (TIDAK DIUBAH)
    public function create()
    {
        return view('pages.mitra.events.create');
    }

    // PROSES SIMPAN (TIDAK DIUBAH)
    public function store(Request $request)
    {
        $request->validate([
            'nama_event' => 'required|string|max:255',
            'tanggal'    => 'required|date',
            'lokasi'     => 'required|string',
            'deskripsi'  => 'required|string',
        ]);

        Event::create([
            'user_id'    => Auth::id(), 
            'nama_event' => $request->nama_event,
            'tanggal'    => $request->tanggal,
            'lokasi'     => $request->lokasi,
            'deskripsi'  => $request->deskripsi,
            'kategori'   => 'umum', 
            'status'     => 'pending', // Default Pending
        ]);

        return redirect()->route('mitra.events.index')->with('success', 'Event berhasil diajukan!');
    }

    // HAPUS EVENT (TIDAK DIUBAH)
    public function destroy($id)
    {
        $event = Event::where('user_id', Auth::id())->findOrFail($id);
        $event->delete();
        return back()->with('success', 'Event berhasil dihapus.');
    }
} 