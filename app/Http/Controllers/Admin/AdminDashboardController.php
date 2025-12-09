<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CatatanKeuangan;
use App\Models\Event; 

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. STATISTIK JUMLAH
            $totalPetani = User::where('role', 'petani')->count();
                $totalMitra  = User::where('role', 'mitra')->count();
                    $totalCatatan = CatatanKeuangan::count();
                        $totalEvent = Event::count();

                            // 2. STATUS EVENT (PENTING AGAR TIDAK ERROR $pending/$approved)
                                $approved = Event::where('status', 'approved')->count();
                                    $pending  = Event::where('status', 'pending')->count();
                                        $rejected = Event::where('status', 'rejected')->count();

                                            // 3. KEUANGAN (PENTING AGAR TIDAK ERROR $saldoAkhir)
                                                $totalPemasukan = CatatanKeuangan::where('jenis', 'pemasukan')->sum('nominal');
                                                    $totalPengeluaran = CatatanKeuangan::where('jenis', 'pengeluaran')->sum('nominal');
                                                        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

                                                            // 4. TABEL & LIST
                                                                $transaksiTerbaru = CatatanKeuangan::with('user')->latest()->paginate(5, ['*'], 'transaksi_page');
                                                                    $eventTerbaru = Event::with('user')->latest()->paginate(5, ['*'], 'event_page');

                                                                        return view('pages.admin.dashboard', compact(
                                                                                'totalPetani', 'totalMitra', 'totalEvent', 'totalCatatan',
                                                                                        'approved', 'pending', 'rejected',
                                                                                                'totalPemasukan', 'totalPengeluaran', 'saldoAkhir',
                                                                                                        'transaksiTerbaru', 'eventTerbaru'
                                                                                                            ));
                                                                                                            }}