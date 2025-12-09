@extends('layouts.guest.app')

@section('title', 'Dashboard Mitra - SawitKu')

@section('content')

{{-- LOGIKA WAKTU --}}
@php
date_default_timezone_set('Asia/Jakarta');
$hour = date('H');
if ($hour >= 5 && $hour < 11) { $greeting='Selamat Pagi' ; $iconGreet='fa-cloud-sun' ; }
    elseif ($hour>= 11 && $hour < 15) { $greeting='Selamat Siang' ; $iconGreet='fa-sun' ; }
        elseif ($hour>= 15 && $hour < 18) { $greeting='Selamat Sore' ; $iconGreet='fa-cloud-meatball' ; }
            else { $greeting='Selamat Malam' ; $iconGreet='fa-moon' ; }
            @endphp

            {{-- 1. ANIMASI DAUN JATUH (BACKGROUND) --}}
            <div class="falling-leaves-container">
            @for ($i = 0; $i < 25; $i++)
                @php
                $colors=['#81C784', '#AED581' , '#FFD54F' , '#FFB74D' , '#00E676' ];
                $randomColor=$colors[array_rand($colors)];
                $leafStyle=[ 'color'=> $randomColor,
                'left' => rand(0, 100) . '%',
                'animation-duration' => rand(10, 25) . 's',
                'animation-delay' => '-' . rand(0, 20) . 's',
                'font-size' => rand(20, 45) . 'px',
                'opacity' => '0.6',
                'text-shadow' => "0 0 5px $randomColor"
                ];
                @endphp
                <div class="leaf glowing-leaf" @style($leafStyle)>
                    <i class="fas fa-leaf"></i>
                </div>
                @endfor
                </div>

                {{-- 2. KONTEN DASHBOARD MITRA --}}
                <div class="dashboard-wrapper position-relative z-2" style="min-height: 100vh;">
                    <div class="container px-4 py-5">

                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center mb-5 animate-fade-down glass-card p-4 rounded-5 shadow-lg overflow-hidden position-relative">

                            <div class="position-absolute top-0 end-0 p-3 opacity-10 pe-none">
                                <i class="fas {{ $iconGreet }}" style="font-size: 8rem; color: var(--accent-green); transform: translate(20px, -20px) rotate(10deg);"></i>
                            </div>

                            <div class="text-center text-lg-start mb-4 mb-lg-0 position-relative z-2">
                                <div class="d-inline-flex align-items-center badge bg-success bg-opacity-10 text-success mb-3 rounded-pill px-4 py-2 fw-bold ls-1 shadow-sm border border-success border-opacity-25">
                                    <i class="fas fa-handshake me-2"></i> MITRA SAWITKU
                                </div>
                                <h1 class="fw-bold text-dark mb-2 display-6">
                                    {{ $greeting }}, <span class="text-success">{{ Auth::user()->name }}</span>!
                                </h1>
                                <p class="text-secondary mb-0 fw-medium">
                                    Kelola event promosi dan penyuluhan Anda di sini.
                                </p>
                            </div>

                            <div class="position-relative z-2">
                                <a href="{{ route('mitra.events.create') }}" class="btn btn-lg btn-gradient-success rounded-pill px-5 py-3 shadow-lg fw-bold hover-scale">
                                    <i class="fas fa-plus-circle me-2"></i> Ajukan Event Baru
                                </a>
                            </div>
                        </div>

                        <div class="row g-4 mb-5">
                            <div class="col-md-3 animate-fade-up" style="animation-delay: 0.1s;">
                                <div class="card border-0 shadow-sm rounded-5 h-100 glass-card hover-lift-sm">
                                    <div class="card-body p-4 d-flex align-items-center">
                                        <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle me-3 shadow-sm">
                                            <i class="fas fa-bullhorn fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-muted text-uppercase x-small fw-bold mb-1">Total Pengajuan</h6>
                                            <h3 class="text-dark fw-bold mb-0">{{ $totalEvent }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 animate-fade-up" style="animation-delay: 0.2s;">
                                <div class="card border-0 shadow-sm rounded-5 h-100 glass-card hover-lift-sm border-bottom border-5 border-success">
                                    <div class="card-body p-4 d-flex align-items-center">
                                        <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle me-3 shadow-sm">
                                            <i class="fas fa-check-circle fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-muted text-uppercase x-small fw-bold mb-1">Disetujui</h6>
                                            <h3 class="text-success fw-bold mb-0">{{ $approved }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 animate-fade-up" style="animation-delay: 0.3s;">
                                <div class="card border-0 shadow-sm rounded-5 h-100 glass-card hover-lift-sm border-bottom border-5 border-warning">
                                    <div class="card-body p-4 d-flex align-items-center">
                                        <div class="icon-box bg-warning bg-opacity-10 text-warning rounded-circle me-3 shadow-sm">
                                            <i class="fas fa-clock fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-muted text-uppercase x-small fw-bold mb-1">Menunggu</h6>
                                            <h3 class="text-warning fw-bold mb-0">{{ $pending }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 animate-fade-up" style="animation-delay: 0.4s;">
                                <div class="card border-0 shadow-sm rounded-5 h-100 glass-card hover-lift-sm border-bottom border-5 border-danger">
                                    <div class="card-body p-4 d-flex align-items-center">
                                        <div class="icon-box bg-danger bg-opacity-10 text-danger rounded-circle me-3 shadow-sm">
                                            <i class="fas fa-times-circle fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-muted text-uppercase x-small fw-bold mb-1">Ditolak</h6>
                                            <h3 class="text-danger fw-bold mb-0">{{ $rejected }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-lg rounded-5 glass-card overflow-hidden animate-fade-up" style="animation-delay: 0.5s;">
                            <div class="card-header bg-transparent border-0 p-4 d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold text-dark mb-0"><i class="fas fa-history me-2 text-success"></i> Pengajuan Terakhir</h5>
                                <a href="{{ route('mitra.events.index') }}" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold">Lihat Semua</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 bg-transparent table-hover">
                                    <thead class="text-secondary x-small text-uppercase bg-light">
                                        <tr>
                                            <th class="ps-4 py-3">Nama Event</th>
                                            <th class="py-3">Tanggal Acara</th>
                                            <th class="py-3">Lokasi</th>
                                            <th class="py-3 text-center">Status</th>
                                            <th class="text-end pe-4 py-3">Dibuat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentEvents as $event)
                                        <tr>
                                            <td class="ps-4 py-3">
                                                <span class="d-block fw-bold text-dark">{{ $event->nama_event }}</span>
                                                <small class="text-muted">{{ Str::limit($event->deskripsi, 40) }}</small>
                                            </td>
                                            <td class="text-secondary small">
                                                <i class="far fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}
                                            </td>
                                            <td class="text-secondary small">
                                                <i class="fas fa-map-marker-alt me-1 text-danger"></i> {{ $event->lokasi }}
                                            </td>
                                            <td class="text-center">
                                                @if($event->status == 'approved')
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3">Tayang</span>
                                                @elseif($event->status == 'rejected')
                                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger rounded-pill px-3">Ditolak</span>
                                                @else
                                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning rounded-pill px-3">Pending</span>
                                                @endif
                                            </td>
                                            <td class="text-end pe-4 text-muted small">
                                                {{ $event->created_at->diffForHumans() }}
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                                                <p>Belum ada event yang diajukan.</p>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                    <div class="p-3 d-flex justify-content-center border-top">
                                        {{ $recentEvents->appends(request()->except('page_my_event'))->links() }}
                                    </div>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <style>
                    /* Style Seragam Guest */
                    .falling-leaves-container {
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        z-index: 0;
                        pointer-events: none;
                        overflow: hidden;
                    }

                    .leaf {
                        position: absolute;
                        top: -10%;
                        animation: fall linear infinite;
                    }

                    .glowing-leaf i {
                        filter: drop-shadow(0 0 5px currentColor);
                    }

                    @keyframes fall {
                        0% {
                            transform: translateY(-10vh) rotate(0deg);
                            opacity: 0;
                        }

                        100% {
                            transform: translateY(110vh) rotate(360deg);
                            opacity: 0;
                        }
                    }

                    .glass-card {
                        background: rgba(255, 255, 255, 0.9);
                        backdrop-filter: blur(20px);
                        border: 1px solid rgba(255, 255, 255, 0.8);
                    }

                    [data-theme="dark"] .glass-card {
                        background: rgba(30, 30, 30, 0.9);
                        border-color: rgba(255, 255, 255, 0.1);
                        color: white;
                    }

                    [data-theme="dark"] .text-dark {
                        color: white !important;
                    }

                    .bg-gradient-green {
                        background: linear-gradient(135deg, #43A047 0%, #66BB6A 100%);
                    }

                    .btn-gradient-success {
                        background: linear-gradient(90deg, #2E7D32 0%, #66BB6A 100%);
                        border: none;
                        color: white;
                        transition: 0.3s;
                    }

                    .btn-gradient-success:hover {
                        transform: translateY(-3px);
                        box-shadow: 0 10px 20px rgba(46, 125, 50, 0.3);
                        color: white;
                    }

                    .icon-box {
                        width: 50px;
                        height: 50px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }

                    .ls-1 {
                        letter-spacing: 1px;
                    }

                    .x-small {
                        font-size: 0.75rem;
                    }

                    .hover-lift-sm:hover {
                        transform: translateY(-5px);
                        transition: 0.3s;
                        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05) !important;
                    }

                    .animate-fade-down {
                        animation: fadeDown 0.8s forwards;
                    }

                    .animate-fade-up {
                        animation: fadeUp 0.8s forwards;
                    }

                    @keyframes fadeDown {
                        from {
                            opacity: 0;
                            transform: translateY(-20px);
                        }

                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }

                    @keyframes fadeUp {
                        from {
                            opacity: 0;
                            transform: translateY(20px);
                        }

                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }
                </style>
                @endsection