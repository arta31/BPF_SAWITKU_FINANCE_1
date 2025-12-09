<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminKeuanganController extends Controller
{
   public function index(Request $request)
{
    // 1. Definisikan kolom yang mau di-search (Sesuai Modul)
    $searchableColumns = ['name', 'email'];

    // 2. QUERY DASAR
    $query = User::where('role', 'petani')
        // Panggil scopeFilter: 
        // Param 1: Request
        // Param 2: [] (Array kosong karena kita filter manual status keuangan di bawah)
        // Param 3: $searchableColumns (Kolom yang mau dicari)
        ->filter($request, [], $searchableColumns) 
        
        ->withSum(['catatan_keuangan as total_masuk' => function($q) {
            $q->where('jenis', 'pemasukan');
        }], 'nominal')
        ->withSum(['catatan_keuangan as total_keluar' => function($q) {
            $q->where('jenis', 'pengeluaran');
        }], 'nominal');

    // ... (LANJUTKAN DENGAN KODE LOGIKA STATUS KEUANGAN & SALDO YANG TADI) ...
    // Kode di bawah ini sama persis dengan yang sebelumnya, tidak perlu diubah
    
    // 3. LOGIKA FILTER STATUS KEUANGAN (MANUAL)
    if ($request->has('status_keuangan') && $request->status_keuangan != '') {
        $status = $request->status_keuangan;
        $rawSaldo = '(COALESCE(total_masuk, 0) - COALESCE(total_keluar, 0))';

        if ($status == 'sultan') {
            $query->havingRaw("$rawSaldo > 5000000");
        } elseif ($status == 'sehat') {
            $query->havingRaw("$rawSaldo > 0 AND $rawSaldo <= 5000000");
        } elseif ($status == 'defisit') {
            $query->havingRaw("$rawSaldo < 0");
        }
    }

    // 4. EKSEKUSI QUERY
    $petaniList = $query->latest()
        ->paginate(10)
        ->withQueryString(); // Agar search tidak hilang saat pindah halaman

    // ... (Sisa kode perhitungan Total System biarkan saja) ...
    $allPetani = User::where('role', 'petani')
            ->withSum(['catatan_keuangan as total_masuk' => function($q) { $q->where('jenis', 'pemasukan'); }], 'nominal')
            ->withSum(['catatan_keuangan as total_keluar' => function($q) { $q->where('jenis', 'pengeluaran'); }], 'nominal')
            ->get();

    $systemMasuk = $allPetani->sum('total_masuk');
    $systemKeluar = $allPetani->sum('total_keluar');
    $systemSaldo = $systemMasuk - $systemKeluar;

    return view('pages.admin.keuangan.index', compact(
        'petaniList', 'systemMasuk', 'systemKeluar', 'systemSaldo'
    ));
}
    }
