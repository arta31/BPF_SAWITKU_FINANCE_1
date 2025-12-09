@extends('layouts.guest.app')

@section('title', 'Event Saya')

@section('content')

{{-- 1. ANIMASI DAUN JATUH (BACKGROUND) - TIDAK DIUBAH --}}
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
        'text-shadow' => "0 0 5px $randomColor",
        ];
        @endphp

        <div class="leaf glowing-leaf" @style($leafStyle)>
            <i class="fas fa-leaf"></i>
        </div>
    @endfor
</div>

<div class="dashboard-wrapper position-relative z-2" style="min-height: 100vh;">
    <div class="container px-4 py-5">

        {{-- HEADER CARD --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 animate-fade-down glass-card p-4 rounded-5 shadow-sm position-relative z-3">
            <div class="d-flex align-items-center gap-4 mb-3 mb-md-0">
                <div class="icon-box-lg bg-gradient-green text-white rounded-circle shadow-lg animate-pulse"
                    style="width: 70px; height: 70px;">
                    <i class="fas fa-calendar-check fa-2x"></i>
                </div>
                <div>
                    <h2 class="fw-bold text-adaptive-primary mb-1">Event Saya</h2>
                    <p class="text-adaptive-secondary fs-6 fw-normal mb-0">
                        Kelola event promosi & penyuluhan Anda di sini.
                    </p>
                </div>
            </div>

            <a href="{{ route('mitra.events.create') }}"
                class="btn btn-lg btn-gradient-success rounded-pill px-5 py-3 shadow-lg fw-bold hover-scale">
                <i class="fas fa-plus-circle me-2"></i> Ajukan Event
            </a>
        </div>

        {{-- === BAGIAN FILTER & SEARCH (BARU DITAMBAHKAN) === --}}
        <div class="row mb-4 animate-fade-down" style="animation-delay: 0.1s;">
            <div class="col-md-12">
                <form method="GET" action="{{ route('mitra.events.index') }}">
                    {{-- Input Hidden Page (Agar pagination tidak reset saat filter) --}}
                    @if(request('page'))
                        <input type="hidden" name="page" value="{{ request('page') }}">
                    @endif

                    <div class="glass-card p-3 rounded-4 shadow-sm">
                        <div class="row g-3 align-items-end">
                            {{-- 1. FILTER STATUS --}}
                            <div class="col-md-3">
                                <label class="text-adaptive-secondary small fw-bold mb-2">Filter Status:</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-muted border-end-0">
                                        <i class="fas fa-filter"></i>
                                    </span>
                                    <select name="status" class="form-select bg-white text-dark border-start-0 shadow-none" 
                                            onchange="this.form.submit()" 
                                            style="cursor: pointer;">
                                        <option value="">Semua Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
                            </div>

                            {{-- 2. SEARCH INPUT --}}
                            <div class="col-md-5">
                                <label class="text-adaptive-secondary small fw-bold mb-2">Cari Event:</label>
                                <div class="input-group">
                                    <input type="text" 
                                           name="search" 
                                           class="form-control bg-white text-dark border-end-0"
                                           placeholder="Nama Event atau Lokasi..."
                                           value="{{ request('search') }}">
                                    
                                    <button type="submit" class="btn btn-outline-secondary bg-white text-dark border-start-0">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- 3. TOMBOL RESET --}}
                            @if(request('search') || request('status'))
                            <div class="col-md-2">
                                <a href="{{ route('mitra.events.index') }}" class="btn btn-light text-danger w-100 border hover-scale-sm">
                                    <i class="fas fa-times me-2"></i> Reset
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- === END BAGIAN FILTER === --}}

        {{-- ALERT SUCCESS --}}
        @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center glass-card animate-fade-up"
            style="background: rgba(46, 125, 50, 0.15);">
            <div class="bg-success text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                <i class="fas fa-check"></i>
            </div>
            <div class="fw-medium text-success">{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- CARD TABEL EVENT --}}
        <div class="card border-0 shadow-lg rounded-5 glass-card overflow-hidden animate-fade-up" style="animation-delay: 0.2s;">
            <div class="table-responsive">
                <table class="table align-middle mb-0 bg-transparent table-hover">
                    <thead class="bg-light bg-opacity-50">
                        <tr>
                            <th class="ps-4 py-4 text-secondary x-small text-uppercase fw-bold" style="letter-spacing: 1px;">Detail Event</th>
                            <th class="py-4 text-secondary x-small text-uppercase fw-bold">Jadwal & Lokasi</th>
                            <th class="py-4 text-center text-secondary x-small text-uppercase fw-bold">Status</th>
                            <th class="text-end pe-4 py-4 text-secondary x-small text-uppercase fw-bold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($events as $event)
                        <tr style="transition: all 0.2s;">
                            {{-- NAMA & DESKRIPSI --}}
                            <td class="ps-4 py-4">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-adaptive-primary fs-6 mb-1">
                                        {{ $event->nama_event }}
                                    </span>
                                    <small class="text-muted text-truncate" style="max-width: 250px;">
                                        {{ $event->deskripsi ?? 'Tidak ada deskripsi' }}
                                    </small>
                                </div>
                            </td>

                            {{-- TANGGAL & LOKASI --}}
                            <td class="py-4">
                                <div class="d-flex flex-column gap-1">
                                    <div class="d-flex align-items-center text-adaptive-secondary small">
                                        <i class="far fa-calendar-alt me-2 text-success opacity-75" style="width: 16px;"></i>
                                        <span class="fw-medium">{{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}</span>
                                    </div>
                                    <div class="d-flex align-items-center text-adaptive-secondary small">
                                        <i class="fas fa-map-marker-alt me-2 text-danger opacity-75" style="width: 16px;"></i>
                                        <span>{{ $event->lokasi }}</span>
                                    </div>
                                </div>
                            </td>

                            {{-- STATUS --}}
                            <td class="text-center py-4">
                                @if ($event->status === 'approved')
                                <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i> Disetujui
                                </span>
                                @elseif ($event->status === 'rejected')
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger rounded-pill px-3 py-2">
                                    <i class="fas fa-times-circle me-1"></i> Ditolak
                                </span>
                                @else
                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning rounded-pill px-3 py-2">
                                    <i class="fas fa-clock me-1"></i> Pending
                                </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="text-end pe-4 py-4">
                                <div class="d-flex justify-content-end gap-2">
                                    {{-- TOMBOL EDIT --}}
                                    @if ($event->status === 'pending' || $event->status === 'rejected')
                                    <a href="{{ route('mitra.events.edit', $event->id) }}"
                                        class="btn btn-icon btn-light text-primary shadow-sm rounded-circle hover-scale"
                                        style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;"
                                        title="Edit Event">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    @endif

                                    {{-- TOMBOL HAPUS --}}
                                    <form action="{{ route('mitra.events.destroy', $event->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-icon btn-light text-danger shadow-sm rounded-circle delete-confirm hover-scale"
                                            style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;"
                                            title="Hapus" onclick="return confirm('Yakin hapus event ini?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center justify-content-center py-4 opacity-50">
                                    <i class="fas fa-folder-open fa-4x mb-3 text-secondary"></i>
                                    <h5 class="text-muted fw-bold">Belum ada event</h5>
                                    <p class="text-muted small mb-3">Mulai ajukan event promosi Anda sekarang.</p>
                                    <a href="{{ route('mitra.events.create') }}" class="btn btn-sm btn-outline-success rounded-pill px-4">
                                        Buat Event Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="px-4 py-3 border-top bg-light bg-opacity-25 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <p class="mb-0 small text-muted">
                    Menampilkan <span class="fw-bold">{{ $events->firstItem() }}</span> - <span class="fw-bold">{{ $events->lastItem() }}</span> dari <span class="fw-bold">{{ $events->total() }}</span> event
                </p>
                
                <div>
                    {{-- Menggunakan style bootstrap-5 sesuai kode awal --}}
                    {{ $events->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

    </div>
</div>

{{-- STYLE KHUSUS HALAMAN INI (TIDAK DIUBAH SAMA SEKALI) --}}
<style>
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
        color: #fff;
    }

    .text-adaptive-primary {
        color: #333;
    }

    .text-adaptive-secondary {
        color: #6c757d;
    }

    [data-theme="dark"] .text-adaptive-primary {
        color: #fff;
    }

    [data-theme="dark"] .text-adaptive-secondary {
        color: #aaa;
    }

    .bg-gradient-green {
        background: linear-gradient(135deg, #43A047 0%, #66BB6A 100%);
    }

    .btn-gradient-success {
        background: linear-gradient(90deg, #2E7D32 0%, #66BB6A 100%);
        border: none;
        color: #fff;
        transition: 0.3s;
    }

    .btn-gradient-success:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(46, 125, 50, 0.3);
        color: #fff;
    }

    .icon-box-lg {
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .x-small {
        font-size: 0.75rem;
    }

    .hover-scale:hover {
        transform: scale(1.05);
        transition: 0.3s;
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

    /* Style tambahan untuk input di mode terang/gelap */
    .form-select, .form-control { border-color: #dee2e6; }
    .form-select:focus, .form-control:focus { border-color: #43A047; box-shadow: 0 0 0 0.25rem rgba(67, 160, 71, 0.25); }
</style>
@endsection