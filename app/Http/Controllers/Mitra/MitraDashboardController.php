<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class MitraDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Hitung Event milik Mitra yang sedang login saja
        $totalEvent = Event::where('user_id', $user->id)->count();
        $pending    = Event::where('user_id', $user->id)->where('status', 'pending')->count();
        $approved   = Event::where('user_id', $user->id)->where('status', 'approved')->count();
        $rejected   = Event::where('user_id', $user->id)->where('status', 'rejected')->count();

        // Ambil 5 event terakhir
        // Ubah ->get() menjadi ->paginate(5)
        $recentEvents = Event::where('user_id', Auth::id())->latest()->paginate(2, ['*'], 'page_my_event');
        
        return view('pages.mitra.dashboard', compact(
            'totalEvent',
            'pending',
            'approved',
            'rejected',
            'recentEvents'
        ));
    }
}
