@extends('layouts.guest.app')

@section('title', 'Admin Command Center')

@section('content')

@php
    date_default_timezone_set('Asia/Jakarta'); 
    $hour = date('H');
    if ($hour >= 5 && $hour < 11) { $greeting = 'Selamat Pagi'; }
    elseif ($hour >= 11 && $hour < 15) { $greeting = 'Selamat Siang'; }
    elseif ($hour >= 15 && $hour < 18) { $greeting = 'Selamat Sore'; }
    else { $greeting = 'Selamat Malam'; }
@endphp

{{-- WRAPPER ADMIN --}}
<div class="admin-container position-relative overflow-hidden" style="min-height: 100vh; background-color: #0f172a;">
    
    {{-- ANIMASI DAUN JATUH NEON --}}
    <div class="falling-leaves-container">
        @for ($i = 0; $i < 30; $i++)
            @php
                $colors = ['#81C784', '#AED581', '#FFD54F', '#FFB74D', '#00E676']; 
                $randomColor = $colors[array_rand($colors)];
                $leafStyles = [
                    'color' => $randomColor,
                    'left' => rand(0, 100) . '%',
                    'animation-duration' => rand(10, 25) . 's',
                    'animation-delay' => '-' . rand(0, 20) . 's',
                    'font-size' => rand(20, 45) . 'px',
                    'opacity' => '0.8',
                    'text-shadow' => "0 0 10px $randomColor",
                ];
            @endphp
            <div class="leaf glowing-leaf" @style($leafStyles)>
                <i class="fas fa-leaf"></i>
            </div>
        @endfor
    </div>

    <div class="container-fluid px-4 py-5 position-relative z-2">
        
        {{-- HEADER DASHBOARD --}}
        <div class="d-flex justify-content-between align-items-end mb-5 animate-fade-down">
            <div>
                <div class="badge bg-gold mb-2 text-dark fw-bold px-3 py-2 rounded-pill"><i class="fas fa-crown me-2"></i> ADMINISTRATOR</div>
                <h1 class="text-white fw-bold display-6">{{ $greeting }}, <span class="text-gold">{{ Auth::user()->name }}</span></h1>
                <p class="text-muted mb-0">Ringkasan ekosistem SawitKu secara real-time.</p>
            </div>
            <div class="text-end text-white">
                <h2 class="fw-bold mb-0">{{ date('H:i') }} <small class="fs-6 fw-normal">WIB</small></h2>
                <small class="text-success"><i class="fas fa-circle fa-xs me-1 blink"></i> System Online</small>
            </div>
        </div>

        {{-- KARTU STATISTIK UTAMA --}}
        <div class="row g-4 mb-5">
            <div class="col-md-3 animate-fade-up" style="animation-delay: 0.1s;">
                <div class="card bg-dark-glass border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-box bg-green-soft text-green rounded-circle me-3"><i class="fas fa-users"></i></div>
                        <div><h6 class="text-muted text-uppercase small fw-bold mb-1">Total Petani</h6><h3 class="text-white fw-bold mb-0">{{ $totalPetani }}</h3></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 animate-fade-up" style="animation-delay: 0.2s;">
                <div class="card bg-dark-glass border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-box bg-blue-soft text-blue rounded-circle me-3"><i class="fas fa-handshake"></i></div>
                        <div><h6 class="text-muted text-uppercase small fw-bold mb-1">Total Mitra</h6><h3 class="text-white fw-bold mb-0">{{ $totalMitra }}</h3></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 animate-fade-up" style="animation-delay: 0.3s;">
                <div class="card bg-dark-glass border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-box bg-purple-soft text-purple rounded-circle me-3"><i class="fas fa-calendar-alt"></i></div>
                        <div><h6 class="text-muted text-uppercase small fw-bold mb-1">Total Event</h6><h3 class="text-white fw-bold mb-0">{{ $totalEvent }}</h3></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 animate-fade-up" style="animation-delay: 0.4s;">
                <div class="card bg-dark-glass border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-box bg-orange-soft text-orange rounded-circle me-3"><i class="fas fa-file-invoice-dollar"></i></div>
                        <div><h6 class="text-muted text-uppercase small fw-bold mb-1">Total Transaksi</h6><h3 class="text-white fw-bold mb-0">{{ $totalCatatan }}</h3></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KEUANGAN GLOBAL --}}
        <div class="row g-4 mb-5">
            <div class="col-md-6 animate-fade-up" style="animation-delay: 0.5s;">
                <div class="card bg-dark-glass border-0 p-4 position-relative overflow-hidden">
                    <div class="position-relative z-2">
                        <p class="text-muted text-uppercase small fw-bold mb-2">Total Pemasukan (All Petani)</p>
                        <h2 class="text-success fw-bolder display-5 mb-0">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h2>
                    </div>
                    <i class="fas fa-chart-line position-absolute bottom-0 end-0 text-success opacity-10 display-1 me-4 mb-2"></i>
                </div>
            </div>
            <div class="col-md-6 animate-fade-up" style="animation-delay: 0.6s;">
                <div class="card bg-dark-glass border-0 p-4 position-relative overflow-hidden">
                    <div class="position-relative z-2">
                        <p class="text-muted text-uppercase small fw-bold mb-2">Total Pengeluaran (All Petani)</p>
                        <h2 class="text-danger fw-bolder display-5 mb-0">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h2>
                    </div>
                    <i class="fas fa-hand-holding-usd position-absolute bottom-0 end-0 text-danger opacity-10 display-1 me-4 mb-2"></i>
                </div>
            </div>
        </div>

        {{-- AREA TABEL & EVENT (SEJAJAR 50:50 & SERAGAM) --}}
        <div class="row g-4">
            
            {{-- 1. TABEL TRANSAKSI PETANI TERBARU --}}
            <div class="col-lg-6 animate-fade-up" style="animation-delay: 1.0s;" id="tabel-transaksi">
                <div class="card bg-dark-glass border-0 h-100 shadow-sm">
                    {{-- Header --}}
                    <div class="card-header bg-transparent border-bottom border-secondary py-3 px-4">
                        <h5 class="text-white fw-bold mb-0" style="font-size: 1rem;">
                            <i class="fas fa-exchange-alt me-2 text-gold"></i> Transaksi Petani Terbaru
                        </h5>
                    </div>

                    {{-- Body --}}
                    <div class="table-responsive flex-grow-1">
                        <table class="table table-dark table-hover mb-0 align-middle" style="background: transparent;">
                            <thead class="text-secondary small fw-bold text-uppercase" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                                <tr>
                                    <th class="ps-4 py-3" style="font-size: 0.75rem;">Petani</th>
                                    <th class="py-3" style="font-size: 0.75rem;">Keterangan</th>
                                    <th class="py-3" style="font-size: 0.75rem;">Jenis</th>
                                    <th class="text-end pe-4 py-3" style="font-size: 0.75rem;">Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksiTerbaru as $item)
                                    <tr>
                                        <td class="ps-4 py-3">
                                            <span class="d-block fw-bold text-white" style="font-size: 0.85rem;">{{ $item->user->name }}</span>
                                        </td>
                                        <td class="text-gray-400" style="font-size: 0.85rem;">
                                            {{ Str::limit($item->deskripsi, 20) }}
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill {{ $item->jenis == 'pemasukan' ? 'bg-success bg-opacity-25 text-success' : 'bg-danger bg-opacity-25 text-danger' }}" style="font-size: 0.7rem;">
                                                {{ ucfirst($item->jenis) }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-4 fw-bold {{ $item->jenis == 'pemasukan' ? 'text-success' : 'text-danger' }}" style="font-size: 0.85rem;">
                                            Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty 
                                    <tr><td colspan="4" class="text-center text-muted py-4">Belum ada data.</td></tr> 
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Footer Pagination --}}
                    @if(method_exists($transaksiTerbaru, 'links'))
                    <div class="card-footer bg-transparent border-top border-secondary py-3 d-flex justify-content-center">
                        {{ $transaksiTerbaru->appends(request()->except('transaksi_page'))->links() }}
                    </div>
                    @endif
                </div>
            </div>
            
            {{-- 2. LIST EVENT MITRA TERBARU (Layout Disamakan dengan Tabel) --}}
            <div class="col-lg-6 animate-fade-up" style="animation-delay: 1.1s;" id="list-event">
                <div class="card bg-dark-glass border-0 h-100 shadow-sm">
                    {{-- Header --}}
                    <div class="card-header bg-transparent border-bottom border-secondary py-3 px-4">
                        <h5 class="text-white fw-bold mb-0" style="font-size: 1rem;">
                            <i class="fas fa-calendar-check me-2 text-blue"></i> Event Mitra Terbaru
                        </h5>
                    </div>

                    {{-- Body --}}
                    <div class="d-flex flex-column flex-grow-1">
                        {{-- Fake Header biar sejajar --}}
                        <div class="px-4 py-3 border-bottom border-secondary d-flex justify-content-between text-secondary small fw-bold text-uppercase" style="border-bottom: 1px solid rgba(255,255,255,0.1) !important;">
                            <span style="font-size: 0.75rem;">Nama Event & Mitra</span>
                            <span style="font-size: 0.75rem;">Status</span>
                        </div>

                        <div class="list-group list-group-flush">
                            @forelse($eventTerbaru as $event)
                                <div class="list-group-item bg-transparent border-bottom border-secondary text-white py-3 px-4 d-flex justify-content-between align-items-center">
                                    {{-- Kiri --}}
                                    <div>
                                        <h6 class="mb-1 fw-bold text-gold" style="font-size: 0.85rem;">{{ $event->nama_event }}</h6>
                                        <small class="text-gray-400" style="font-size: 0.75rem;">
                                            <i class="fas fa-user me-1"></i> {{ $event->user->name }}
                                        </small>
                                    </div>

                                    {{-- Kanan --}}
                                    <div>
                                        @if($event->status == 'approved')
                                            <span class="badge bg-success bg-opacity-25 text-success rounded-pill" style="font-size: 0.7rem;">Tayang</span>
                                        @elseif($event->status == 'rejected')
                                            <span class="badge bg-danger bg-opacity-25 text-danger rounded-pill" style="font-size: 0.7rem;">Ditolak</span>
                                        @else
                                            <span class="badge bg-warning bg-opacity-25 text-warning rounded-pill" style="font-size: 0.7rem;">Pending</span>
                                        @endif
                                    </div>
                                </div>
                            @empty 
                                <div class="text-center py-5 text-muted"><p>Belum ada event.</p></div> 
                            @endforelse
                        </div>
                    </div>

                    {{-- Footer Pagination --}}
                    @if(method_exists($eventTerbaru, 'links'))
                    <div class="card-footer bg-transparent border-top border-secondary py-3 d-flex justify-content-center">
                        {{ $eventTerbaru->appends(request()->except('event_page'))->links() }}
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* --- DAUN JATUH ADMIN (FIXED) --- */
    .falling-leaves-container {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%; 
        z-index: 0; pointer-events: none; overflow: hidden;
    }
    .leaf { position: absolute; top: -10%; animation: fall linear infinite; }
    .glowing-leaf i { text-shadow: 0 0 5px currentColor; }
    @keyframes fall { 0% { transform: translateY(-10vh) rotate(0deg); opacity: 0; } 100% { transform: translateY(110vh) rotate(360deg); opacity: 0; } }

    /* Admin Styles */
    .bg-dark-glass { background-color: #1e293b; border: 1px solid #334155 !important; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
    .icon-box { width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
    .bg-green-soft { background: rgba(16, 185, 129, 0.2); } .text-green { color: #34d399; }
    .bg-blue-soft { background: rgba(59, 130, 246, 0.2); } .text-blue { color: #60a5fa; }
    .bg-purple-soft { background: rgba(139, 92, 246, 0.2); } .text-purple { color: #a78bfa; }
    .bg-orange-soft { background: rgba(249, 115, 22, 0.2); } .text-orange { color: #fb923c; }
    .bg-gold { background: #f59e0b; } .text-gold { color: #fbbf24; }
    .text-gray-400 { color: #94a3b8 !important; }
    .table-dark { --bs-table-bg: transparent; --bs-table-hover-bg: rgba(255,255,255,0.05); border-color: #334155; }
    .blink { animation: blink 1s infinite; } @keyframes blink { 50% { opacity: 0; } }
    .animate-fade-down { animation: fadeInDown 0.8s forwards; } .animate-fade-up { animation: fadeInUp 0.8s forwards; }
    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection