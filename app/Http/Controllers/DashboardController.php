<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatatanKeuangan;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()   
    {
        $userId = Auth::id();

        // 1. BUAT BASE QUERY (Jangan di-get dulu agar ringan)
        $query = CatatanKeuangan::where('user_id', $userId);

        // 2. HITUNG-HITUNGAN (Langsung di database, lebih cepat)
        // Gunakan clone() agar query asli tidak berubah
        $totalPemasukan = (clone $query)->where('jenis', 'pemasukan')->sum('nominal');
        $totalPengeluaran = (clone $query)->where('jenis', 'pengeluaran')->sum('nominal');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        // 3. AMBIL DATA AKTIVITAS (Gunakan Paginate)
        // Kita beri nama halaman 'page_activity' agar unik
        $riwayatTerakhir = (clone $query)->latest()->paginate(2, ['*'], 'page_activity');

        // *Opsional: Jika Anda butuh variabel $catatans untuk grafik atau hitungan lain
        // Sebaiknya jangan load semua jika tidak perlu. 
        // Tapi jika view Anda error tanpa $catatans, aktifkan baris ini:
        // $catatans = $query->get(); 
        // Jika tidak dipakai, hapus saja dari compact.

        // 4. AMBIL DATA EVENT
        $events = Event::where('status', 'approved')->latest()->take(5)->get();

        return view('pages.guest.dashboard', compact(
            'totalPemasukan', 
            'totalPengeluaran', 
            'saldoAkhir', 
            'riwayatTerakhir', // <-- Ini sekarang objek Paginator
            'events'
            // 'catatans' <-- Hapus ini jika tidak dipakai looping di view dashboard
        ));
    }
}