<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    // 1. TAMPILKAN SEMUA EVENT
public function index(Request $request)
{
    // 1. Filter: Status (Pending, Approved, Rejected)
    $filterableColumns = ['status'];

    // 2. Search: Nama Event & Lokasi
    $searchableColumns = ['nama_event', 'lokasi'];

    $events = Event::with('user') // Eager load user agar query ringan
        ->latest()
        ->filter($request, $filterableColumns, $searchableColumns) // Panggil scopeFilter
        ->paginate(10)
        ->withQueryString(); // Jaga filter saat ganti halaman

return view('pages.admin.events.index', compact('events'));}

    // 2. TOMBOL SETUJUI (APPROVE)
    public function approve($id)
    {
        $event = Event::findOrFail($id);
        $event->update(['status' => 'approved']);
        
        return back()->with('success', 'Event berhasil disetujui dan akan tayang.');
    }

    // 3. TOMBOL TOLAK (REJECT)
    public function reject($id)
    {
        $event = Event::findOrFail($id);
        $event->update(['status' => 'rejected']);
        
        return back()->with('error', 'Event ditolak.');
    }

    // 4. HAPUS EVENT
    public function destroy($id)
    {
        Event::destroy($id);
        return back()->with('success', 'Event dihapus permanen.');
    }
}