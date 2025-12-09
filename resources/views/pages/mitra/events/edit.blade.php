@extends('layouts.guest.app')

@section('title', 'Edit Event')

@section('content')

{{-- 1. ANIMASI DAUN JATUH (BACKGROUND) - AGAR KONSISTEN DENGAN INDEX --}}
<div class="falling-leaves-container">
    @for ($i = 0; $i < 20; $i++)
        @php
        $colors=['#81C784', '#AED581' , '#FFD54F' , '#FFB74D' , '#00E676' ];
        $randomColor=$colors[array_rand($colors)];
        $leafStyle=[ 'color'=> $randomColor,
        'left' => rand(0, 100) . '%',
        'animation-duration' => rand(15, 30) . 's',
        'animation-delay' => '-' . rand(0, 20) . 's',
        'font-size' => rand(20, 40) . 'px',
        'opacity' => '0.4',
        ];
        @endphp

        <div class="leaf glowing-leaf" @style($leafStyle)>
            <i class="fas fa-leaf"></i>
        </div>
    @endfor
</div>

<div class="dashboard-wrapper position-relative z-2" style="min-height: 100vh;">
    <div class="container px-4 py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                {{-- HEADER KECIL --}}
                <div class="mb-4 text-center animate-fade-down">
                    <h2 class="fw-bold text-adaptive-primary mb-2">Edit Kegiatan</h2>
                    <p class="text-adaptive-secondary">Perbarui informasi event Anda agar lebih menarik.</p>
                </div>

                {{-- CARD FORM --}}
                <div class="card border-0 shadow-lg rounded-5 glass-card animate-fade-up">
                    <div class="card-body p-4 p-md-5">
                        
                        <form action="{{ route('mitra.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- 1. NAMA EVENT --}}
                            <div class="mb-4">
                                <label for="nama_event" class="form-label fw-bold text-adaptive-primary small text-uppercase ls-1">
                                    Nama Event
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0 text-success">
                                        <i class="fas fa-heading"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control border-start-0 ps-0" 
                                           id="nama_event" 
                                           name="nama_event" 
                                           value="{{ old('nama_event', $event->nama_event) }}" 
                                           placeholder="Contoh: Penyuluhan Sawit Lestari" 
                                           required>
                                </div>
                                @error('nama_event')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row">
                                {{-- 2. TANGGAL --}}
                                <div class="col-md-6 mb-4">
                                    <label for="tanggal" class="form-label fw-bold text-adaptive-primary small text-uppercase ls-1">
                                        Tanggal Pelaksanaan
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-transparent border-end-0 text-success">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                        <input type="date" 
                                               class="form-control border-start-0 ps-0" 
                                               id="tanggal" 
                                               name="tanggal" 
                                               value="{{ old('tanggal', $event->tanggal) }}" 
                                               required>
                                    </div>
                                    @error('tanggal')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- 3. LOKASI --}}
                                <div class="col-md-6 mb-4">
                                    <label for="lokasi" class="form-label fw-bold text-adaptive-primary small text-uppercase ls-1">
                                        Lokasi
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-transparent border-end-0 text-danger">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        <input type="text" 
                                               class="form-control border-start-0 ps-0" 
                                               id="lokasi" 
                                               name="lokasi" 
                                               value="{{ old('lokasi', $event->lokasi) }}" 
                                               placeholder="Nama Gedung / Desa" 
                                               required>
                                    </div>
                                    @error('lokasi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- 4. DESKRIPSI --}}
                            <div class="mb-5">
                                <label for="deskripsi" class="form-label fw-bold text-adaptive-primary small text-uppercase ls-1">
                                    Deskripsi & Catatan
                                </label>
                                <textarea class="form-control" 
                                          id="deskripsi" 
                                          name="deskripsi" 
                                          rows="4" 
                                          placeholder="Tuliskan detail lengkap acara di sini..."
                                          style="border-radius: 15px;">{{ old('deskripsi', $event->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- TOMBOL AKSI --}}
                            <div class="d-flex justify-content-end gap-3 pt-3 border-top border-secondary border-opacity-10">
                                <a href="{{ route('mitra.events.index') }}" class="btn btn-light rounded-pill px-4 fw-bold text-secondary">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-gradient-success rounded-pill px-5 fw-bold shadow-sm hover-scale">
                                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- CSS KHUSUS HALAMAN INI (Menggunakan Variabel dari App.blade.php) --}}
<style>
    /* Styling agar input mengikuti tema Dark/Light */
    .form-control, .input-group-text {
        background-color: var(--input-bg);
        color: var(--text-main);
        border-color: var(--border-color);
        transition: all 0.3s;
    }

    .form-control:focus {
        background-color: var(--input-bg);
        color: var(--text-main);
        border-color: var(--accent-green);
        box-shadow: 0 0 0 4px rgba(46, 125, 50, 0.1);
    }

    /* Placeholder color fix */
    .form-control::placeholder {
        color: var(--text-muted);
        opacity: 0.7;
    }

    /* Input Group Fix */
    .input-group-text {
        border-color: var(--border-color);
    }

    .ls-1 {
        letter-spacing: 1px;
    }
    
    /* Animation & Glass Effect (Sama seperti Index) */
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

    .text-adaptive-primary { color: var(--text-main); }
    .text-adaptive-secondary { color: var(--text-muted); }

    /* Button Gradient */
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
    .hover-scale:hover { transform: scale(1.02); }

    /* Background Animation */
    .falling-leaves-container {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        z-index: 0; pointer-events: none; overflow: hidden;
    }
    .leaf { position: absolute; top: -10%; animation: fall linear infinite; }
    .glowing-leaf i { filter: drop-shadow(0 0 5px currentColor); }
    @keyframes fall {
        0% { transform: translateY(-10vh) rotate(0deg); opacity: 0; }
        100% { transform: translateY(110vh) rotate(360deg); opacity: 0; }
    }
    
    .animate-fade-up { animation: fadeUp 0.8s forwards; }
    .animate-fade-down { animation: fadeDown 0.8s forwards; }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
</style>

@endsection