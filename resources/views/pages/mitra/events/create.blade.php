@extends('layouts.guest.app')

@section('title', 'Ajukan Event Baru')

@section('content')

{{-- ANIMASI DAUN JATUH --}}
<div class="falling-leaves-container">
    @for ($i = 0; $i < 25; $i++)
        @php
            $colors = ['#81C784', '#AED581', '#FFD54F', '#FFB74D', '#00E676']; 
            $randomColor = $colors[array_rand($colors)];
            $leafStyle = [ 'color' => $randomColor, 'left' => rand(0, 100) . '%', 'animation-duration' => rand(10, 25) . 's', 'animation-delay' => '-' . rand(0, 20) . 's', 'font-size' => rand(20, 45) . 'px', 'opacity' => '0.6', 'text-shadow' => "0 0 5px $randomColor" ];
        @endphp
        <div class="leaf glowing-leaf" @style($leafStyle)><i class="fas fa-leaf"></i></div>
    @endfor
</div>

<div class="dashboard-wrapper position-relative z-2" style="min-height: 100vh;">
    <div class="container px-4 py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="d-flex justify-content-between align-items-center mb-4 animate-fade-down">
                    <div>
                        <a href="{{ route('mitra.events.index') }}" class="text-secondary text-decoration-none fw-bold small mb-2 d-block hover-scale-sm">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <h2 class="fw-bold text-adaptive-primary mb-0">Formulir Event</h2>
                    </div>
                </div>

                <div class="card border-0 shadow-lg rounded-5 glass-card overflow-hidden animate-fade-up">
                    <div class="position-absolute top-0 start-0 w-100 bg-gradient-green" style="height: 6px;"></div>
                    <div class="card-body p-5">
                        <form action="{{ route('mitra.events.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label class="form-label text-success small fw-bold text-uppercase ls-1">Nama Event / Promo</label>
                                <div class="input-group shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0 ps-3"><i class="fas fa-tag text-muted"></i></span>
                                    <input type="text" name="nama_event" class="form-control border-0 ps-2" placeholder="Contoh: Diskon Pupuk 50%" required>
                                </div>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-success small fw-bold text-uppercase ls-1">Tanggal Pelaksanaan</label>
                                    <div class="input-group shadow-sm rounded-pill overflow-hidden">
                                        <span class="input-group-text bg-white border-0 ps-3"><i class="far fa-calendar-alt text-muted"></i></span>
                                        <input type="date" name="tanggal" class="form-control border-0 ps-2" required style="cursor: pointer;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-success small fw-bold text-uppercase ls-1">Lokasi</label>
                                    <div class="input-group shadow-sm rounded-pill overflow-hidden">
                                        <span class="input-group-text bg-white border-0 ps-3"><i class="fas fa-map-marker-alt text-muted"></i></span>
                                        <input type="text" name="lokasi" class="form-control border-0 ps-2" placeholder="Nama Tempat / Online" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-5">
                                <label class="form-label text-success small fw-bold text-uppercase ls-1">Deskripsi Lengkap</label>
                                <div class="input-group shadow-sm rounded-4 overflow-hidden">
                                    <span class="input-group-text bg-white border-0 ps-3 align-items-start pt-3"><i class="fas fa-align-left text-muted"></i></span>
                                    <textarea name="deskripsi" class="form-control border-0 ps-2 py-3" rows="4" placeholder="Jelaskan detail acara atau promo Anda..." required></textarea>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-gradient-success py-3 rounded-pill fw-bold shadow-lg hover-scale position-relative overflow-hidden">
                                    <span class="position-relative z-2"><i class="fas fa-paper-plane me-2"></i> AJUKAN SEKARANG</span>
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
    /* Style Seragam Guest (Sama dengan Dashboard) */
    .falling-leaves-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; pointer-events: none; overflow: hidden; }
    .leaf { position: absolute; top: -10%; animation: fall linear infinite; }
    .glowing-leaf i { filter: drop-shadow(0 0 5px currentColor); }
    @keyframes fall { 0% { transform: translateY(-10vh) rotate(0deg); opacity: 0; } 100% { transform: translateY(110vh) rotate(360deg); opacity: 0; } }

    .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.8); }
    [data-theme="dark"] .glass-card { background: rgba(30, 30, 30, 0.9); border-color: rgba(255, 255, 255, 0.1); color: white; }

    .text-adaptive-primary { color: #333; }
    [data-theme="dark"] .text-adaptive-primary { color: #fff; }

    .bg-gradient-green { background: linear-gradient(135deg, #43A047 0%, #66BB6A 100%); }
    .btn-gradient-success { background: linear-gradient(90deg, #2E7D32 0%, #66BB6A 100%); border: none; color: white; transition: 0.3s; }
    .btn-gradient-success:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(46, 125, 50, 0.3); color: white; }
    
    .form-control:focus, .form-select:focus { box-shadow: none; background-color: #f8f9fa; color: #198754; }
    .input-group:focus-within { box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.2) !important; border: 1px solid #2E7D32; }
    .input-group-text { background-color: #fff; }

    .ls-1 { letter-spacing: 1px; }
    .hover-scale:hover { transform: scale(1.02); transition: 0.3s; }
    .shine-effect { position: absolute; top: 0; left: -100%; width: 50%; height: 100%; background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%); transform: skewX(-25deg); animation: shine 3s infinite; }
    @keyframes shine { 100% { left: 200%; } }

    .animate-fade-down { animation: fadeDown 0.8s forwards; }
    .animate-fade-up { animation: fadeUp 0.8s forwards; }
    @keyframes fadeDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection