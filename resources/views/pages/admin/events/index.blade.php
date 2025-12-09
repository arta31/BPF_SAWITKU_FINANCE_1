@extends('layouts.guest.app')

@section('title', 'Moderasi Event Mitra')

@section('content')

{{-- 1. ANIMASI DAUN JATUH (BACKGROUND) --}}
<div class="falling-leaves-container">
    @for ($i = 0; $i < 25; $i++)
        @php
            $colors = ['#81C784', '#AED581', '#FFD54F', '#FFB74D', '#00E676']; 
            $randomColor = $colors[array_rand($colors)];
            $leafStyle = [
                'color' => $randomColor,
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

<div class="dashboard-wrapper position-relative z-2" style="min-height: 100vh;">
    <div class="container px-4 py-5">
        
        {{-- HEADER PAGE --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 animate-fade-down glass-card p-4 rounded-5 shadow-sm position-relative z-3">
            <div class="d-flex align-items-center gap-4 mb-3 mb-md-0">
                <div class="icon-box-lg bg-gradient-green text-white rounded-circle shadow-lg animate-pulse" style="width: 70px; height: 70px;">
                    <i class="fas fa-gavel fa-2x"></i>
                </div>
                <div>
                    <h2 class="fw-bold text-adaptive-primary mb-1">Moderasi Konten</h2>
                    <p class="text-adaptive-secondary fs-6 fw-normal mb-0">Setujui atau tolak pengajuan event dari mitra.</p>
                </div>
            </div>
            
            <div class="d-flex gap-2">
                <span class="badge bg-white text-secondary border px-3 py-2 rounded-pill shadow-sm">
                    Total: {{ $events->total() }}
                </span>
            </div>
        </div>

        {{-- === FILTER & SEARCH SECTION (BARU) === --}}
 {{-- === FILTER & SEARCH SECTION (VERSI SESUAI MODUL) === --}}
<div class="row mb-4 animate-fade-down">
    <div class="col-md-12">
{{-- Sesuaikan dengan nama route di web.php kamu ('events.index') --}}
<form method="GET" action="{{ route('admin.events.index') }}">            {{-- 1. INPUT HIDDEN PAGE (Sesuai Modul: Agar page tidak hilang) --}}
            @if(request('page'))
                <input type="hidden" name="page" value="{{ request('page') }}">
            @endif

            <div class="row g-3">
                {{-- FILTER ROLE --}}
                <div class="col-md-3">
                    <label class="text-gray-400 small fw-bold mb-2">Filter Role:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark-glass text-gray-400 border-end-0">
                            <i class="fas fa-filter"></i>
                        </span>
                        {{-- LOGIKA SELECTED (Sesuai Modul) --}}
                        <select name="role" class="form-select bg-dark-glass text-white border-start-0 shadow-none" 
                                onchange="this.form.submit()" 
                                style="cursor: pointer;">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="mitra" {{ request('role') == 'mitra' ? 'selected' : '' }}>Mitra</option>
                            <option value="petani" {{ request('role') == 'petani' ? 'selected' : '' }}>Petani</option>
                        </select>
                    </div>
                </div>

                {{-- SEARCH INPUT --}}
                <div class="col-md-4">
                    <label class="text-gray-400 small fw-bold mb-2">Cari User:</label>
                    <div class="input-group">
                        <input type="text" 
                               name="search" 
                               class="form-control bg-dark-glass text-white border-end-0"
                               placeholder="Nama atau Email..."
                               value="{{ request('search') }}">
                        
                        <button type="submit" class="btn btn-outline-secondary bg-dark-glass text-white border-start-0">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                {{-- TOMBOL RESET (UPGRADE SESUAI MODUL) --}}
                @if(request('search') || request('role'))
                <div class="col-md-2 d-flex align-items-end">
                    {{-- 
                        Menggunakan fullUrlWithQuery(['search' => null, 'role' => null]) 
                        Ini cara Laravel untuk menghapus parameter tertentu dari URL saat ini.
                    --}}
                    <a href="{{ route('admin.events.index') }}" class="btn btn-danger bg-opacity-25 border-danger text-danger w-100">
                        <i class="fas fa-times me-2"></i> Reset
                    </a>
                </div>
                @endif
            </div>
        </form>
    </div>
</div>
        {{-- === END SECTION === --}}

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center glass-card animate-fade-up" style="background: rgba(46, 125, 50, 0.15);">
                <i class="fas fa-check-circle me-3 fs-4 text-success"></i>
                <div class="fw-medium text-success">{{ session('success') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 shadow-lg rounded-5 glass-card overflow-hidden animate-fade-up" style="animation-delay: 0.2s;">
            <div class="table-responsive">
                <table class="table align-middle mb-0 bg-transparent table-hover">
                    <thead class="text-secondary x-small text-uppercase bg-light">
                        <tr>
                            <th class="ps-4 py-3">Info Event</th>
                            <th class="py-3">Mitra Pengaju</th>
                            <th class="py-3">Jadwal & Lokasi</th>
                            <th class="py-3 text-center">Status</th>
                            <th class="text-end pe-4 py-3" style="min-width: 150px;">Aksi Moderasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                        <tr class="border-bottom border-light">
                            <td class="ps-4 py-3">
                                <span class="d-block fw-bold text-adaptive-primary">{{ $event->nama_event }}</span>
                                <small class="text-muted d-block text-truncate" style="max-width: 200px;">{{ $event->deskripsi }}</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-secondary rounded-circle me-2 d-flex align-items-center justify-content-center text-white fw-bold" style="width: 30px; height: 30px; font-size: 12px;">
                                        {{ substr($event->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="d-block fw-bold text-adaptive-primary small">{{ $event->user->name }}</span>
                                        <small class="text-muted x-small">Mitra</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column small">
                                    <span class="text-adaptive-secondary mb-1">
                                        <i class="far fa-calendar-alt me-1 text-success"></i> {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}
                                    </span>
                                    <span class="text-adaptive-secondary">
                                        <i class="fas fa-map-marker-alt me-1 text-danger"></i> {{ $event->lokasi }}
                                    </span>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($event->status == 'approved')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3">Tayang</span>
                                @elseif($event->status == 'rejected')
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger rounded-pill px-3">Ditolak</span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning rounded-pill px-3 animate-pulse">Menunggu</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                @if($event->status == 'pending')
                                    {{-- TOMBOL AKSI UNTUK PENDING --}}
                                    <div class="d-flex justify-content-end gap-2">
                                        <form action="{{ route('admin.events.reject', $event->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-sm btn-light text-danger rounded-circle shadow-sm hover-scale-sm" title="Tolak Event" onclick="return confirm('Yakin tolak event ini?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.events.approve', $event->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-sm btn-gradient-success rounded-circle shadow-lg hover-scale-sm" title="Setujui Event">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    {{-- TOMBOL HAPUS (Jika sudah diapprove/reject) --}}
                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-light text-secondary rounded-circle delete-confirm shadow-sm" title="Hapus Permanen" onclick="return confirm('Hapus data ini selamanya?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 opacity-25"></i>
                                <p>Belum ada pengajuan event dari Mitra.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="d-flex justify-content-center py-4 bg-light bg-opacity-10 border-top">
                {{ $events->links() }}
            </div>
        </div>

    </div>
</div>

<style>
    /* --- STYLE SERAGAM (SAMA DENGAN DASHBOARD) --- */
    
    /* Daun Jatuh */
    .falling-leaves-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; pointer-events: none; overflow: hidden; }
    .leaf { position: absolute; top: -10%; animation: fall linear infinite; }
    .glowing-leaf i { filter: drop-shadow(0 0 5px currentColor); }
    @keyframes fall { 0% { transform: translateY(-10vh) rotate(0deg); opacity: 0; } 100% { transform: translateY(110vh) rotate(360deg); opacity: 0; } }

    /* Glass Card */
    .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.8); }
    [data-theme="dark"] .glass-card { background: rgba(30, 30, 30, 0.9); border-color: rgba(255, 255, 255, 0.1); color: white; }
    
    /* Text Colors */
    .text-adaptive-primary { color: #333; }
    .text-adaptive-secondary { color: #6c757d; }
    [data-theme="dark"] .text-adaptive-primary { color: #fff; }
    [data-theme="dark"] .text-adaptive-secondary { color: #aaa; }

    /* Buttons */
    .bg-gradient-green { background: linear-gradient(135deg, #43A047 0%, #66BB6A 100%); }
    .btn-gradient-success { background: linear-gradient(90deg, #2E7D32 0%, #66BB6A 100%); border: none; color: white; transition: 0.3s; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; }
    .btn-gradient-success:hover { transform: scale(1.1); box-shadow: 0 5px 15px rgba(46, 125, 50, 0.3); color: white; }
    
    .hover-scale-sm:hover { transform: scale(1.05); transition: 0.2s; }
    .icon-box-lg { width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; }

    /* Animations */
    .animate-pulse { animation: pulse 2s infinite; }
    @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.05); } 100% { transform: scale(1); } }
    .animate-fade-down { animation: fadeDown 0.8s forwards; }
    .animate-fade-up { animation: fadeUp 0.8s forwards; }
    @keyframes fadeDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    
    /* Input Style (Agar senada dengan light theme default moderasi) */
    .form-select, .form-control { border-color: #dee2e6; }
    .form-select:focus, .form-control:focus { border-color: #43A047; box-shadow: 0 0 0 0.25rem rgba(67, 160, 71, 0.25); }
</style>
@endsection