@extends('layouts.guest.app')

@section('title', 'Tambah User Baru')

@section('content')

{{-- 1. ANIMASI DAUN JATUH (BACKGROUND) --}}
<div class="falling-leaves-container">
    @for ($i = 0; $i < 25; $i++)
        @php
            $colors = ['#81C784', '#AED581', '#FFD54F', '#FFB74D', '#00E676']; 
            $randomColor = $colors[array_rand($colors)];
            $leftPos = rand(0, 100); 
            $duration = rand(10, 25); 
            $delay = rand(0, 20);
            $size = rand(20, 45);
            
            // Style Array untuk @style
            $leafStyle = [
                'color' => $randomColor,
                'left' => $leftPos . '%',
                'animation-duration' => $duration . 's',
                'animation-delay' => '-' . $delay . 's',
                'font-size' => $size . 'px',
                'opacity' => '0.6',
                'text-shadow' => "0 0 5px $randomColor"
            ];
        @endphp
        <div class="leaf glowing-leaf" @style($leafStyle)>
            <i class="fas fa-leaf"></i>
        </div>
    @endfor
</div>

{{-- 2. KONTEN UTAMA --}}
<div class="dashboard-wrapper position-relative z-2" style="min-height: 100vh;">
    <div class="container px-4 py-5">
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="d-flex justify-content-between align-items-center mb-4 animate-fade-down">
                    <div>
                        <a href="{{ route('admin.users.index') }}" class="text-secondary text-decoration-none fw-bold small mb-2 d-block hover-scale-sm">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke List
                        </a>
                        <h2 class="fw-bold text-dark mb-0">Tambah Pengguna Baru</h2>
                        <p class="text-muted small mb-0">Buat akun untuk Petani, Mitra, atau Admin baru.</p>
                    </div>
                    <div class="icon-box-lg bg-success bg-opacity-10 text-success rounded-circle shadow-sm animate-pulse">
                        <i class="fas fa-user-plus fa-2x"></i>
                    </div>
                </div>

                <div class="card border-0 shadow-lg rounded-5 glass-card overflow-hidden animate-fade-up">
                    <div class="position-absolute top-0 start-0 w-100 bg-gradient-green" style="height: 6px;"></div>

                    <div class="card-body p-5">
                        
                        <form action="{{ route('admin.users.store') }}" method="POST">
                            @csrf
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-success small fw-bold text-uppercase ls-1">Nama Lengkap</label>
                                    <div class="input-group shadow-sm rounded-pill overflow-hidden">
                                        <span class="input-group-text bg-white border-0 ps-3"><i class="fas fa-user text-muted"></i></span>
                                        <input type="text" name="name" class="form-control border-0 ps-2" placeholder="Nama User" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-success small fw-bold text-uppercase ls-1">Email</label>
                                    <div class="input-group shadow-sm rounded-pill overflow-hidden">
                                        <span class="input-group-text bg-white border-0 ps-3"><i class="fas fa-envelope text-muted"></i></span>
                                        <input type="email" name="email" class="form-control border-0 ps-2" placeholder="email@contoh.com" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-success small fw-bold text-uppercase ls-1">Password Default</label>
                                    <div class="input-group shadow-sm rounded-pill overflow-hidden bg-light">
                                        <span class="input-group-text bg-transparent border-0 ps-3"><i class="fas fa-key text-muted"></i></span>
                                        <input type="text" name="password" class="form-control bg-transparent border-0 ps-2 text-muted" value="password123" readonly>
                                    </div>
                                    <small class="text-muted fst-italic x-small ms-2">*User bisa mengubahnya nanti.</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-success small fw-bold text-uppercase ls-1">Kontak (HP)</label>
                                    <div class="input-group shadow-sm rounded-pill overflow-hidden">
                                        <span class="input-group-text bg-white border-0 ps-3"><i class="fas fa-phone text-muted"></i></span>
                                        <input type="text" name="kontak" class="form-control border-0 ps-2" placeholder="0812...">
                                    </div>
                                </div>
                            </div>

                            <div class="row g-4 mb-5">
                                <div class="col-md-6">
                                    <label class="form-label text-success small fw-bold text-uppercase ls-1">Role (Peran)</label>
                                    <div class="input-group shadow-sm rounded-pill overflow-hidden">
                                        <span class="input-group-text bg-white border-0 ps-3"><i class="fas fa-id-badge text-muted"></i></span>
                                        <select name="role" class="form-select border-0 ps-2 cursor-pointer">
                                            <option value="petani">🌱 Petani (User Biasa)</option>
                                            <option value="mitra">🤝 Mitra (Partner)</option>
                                            <option value="admin">🛡️ Administrator</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-success small fw-bold text-uppercase ls-1">Status Akun</label>
                                    <div class="input-group shadow-sm rounded-pill overflow-hidden">
                                        <span class="input-group-text bg-white border-0 ps-3"><i class="fas fa-toggle-on text-muted"></i></span>
                                        <select name="status_akun" class="form-select border-0 ps-2 cursor-pointer">
                                            <option value="aktif">✅ Aktif</option>
                                            <option value="pending">⏳ Pending</option>
                                            <option value="blokir">🚫 Blokir</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-gradient-success py-3 rounded-pill fw-bold shadow-lg hover-scale position-relative overflow-hidden">
                                    <span class="position-relative z-2"><i class="fas fa-save me-2"></i> SIMPAN DATA PENGGUNA</span>
                                    <div class="shine-effect"></div>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    /* --- GUEST THEME ADAPTATION --- */
    
    /* Background Daun Jatuh */
    .falling-leaves-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; pointer-events: none; overflow: hidden; }
    .leaf { position: absolute; top: -10%; animation: fall linear infinite; }
    .glowing-leaf i { filter: drop-shadow(0 0 5px currentColor); }
    @keyframes fall { 0% { transform: translateY(-10vh) rotate(0deg); opacity: 0; } 100% { transform: translateY(110vh) rotate(360deg); opacity: 0; } }

    /* Glass Card */
    .glass-card {
        background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.8);
    }
    [data-theme="dark"] .glass-card {
        background: rgba(30, 30, 30, 0.9); border-color: rgba(255, 255, 255, 0.1);
    }

    /* Form Input Style */
    .form-control:focus, .form-select:focus {
        box-shadow: none; background-color: #f8f9fa; color: #198754;
    }
    .input-group:focus-within {
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.2) !important; border: 1px solid #2E7D32;
    }
    .input-group-text { background-color: #fff; }

    /* Tombol Hijau SawitKu */
    .bg-gradient-green { background: linear-gradient(135deg, #43A047 0%, #66BB6A 100%); }
    .btn-gradient-success { background: linear-gradient(90deg, #2E7D32 0%, #66BB6A 100%); border: none; color: white; transition: 0.3s; }
    .btn-gradient-success:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(46, 125, 50, 0.3); color: white; }

    /* Utils */
    .ls-1 { letter-spacing: 1px; }
    .x-small { font-size: 0.75rem; }
    .cursor-pointer { cursor: pointer; }
    .icon-box-lg { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; }
    
    .animate-fade-down { animation: fadeDown 0.8s forwards; }
    .animate-fade-up { animation: fadeUp 0.8s forwards; }
    @keyframes fadeDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

    /* Shine Effect pada Tombol */
    .shine-effect {
        position: absolute; top: 0; left: -100%; width: 50%; height: 100%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
        transform: skewX(-25deg); animation: shine 3s infinite;
    }
    @keyframes shine { 100% { left: 200%; } }
</style>
@endsection