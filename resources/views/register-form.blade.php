@extends('layouts.guest.app')

@section('title', 'Daftar Akun Baru')

@section('content')

{{-- BACKGROUND DAUN JATUH (DIPERBAIKI: FIXED POSITION) --}}
<div class="falling-leaves-container premium-leaves">
    @for ($i = 0; $i < 20; $i++)
        @php
            $colors = ['#1B5E20', '#2E7D32', '#43A047', '#AED581'];
            $randomColor = $colors[array_rand($colors)];
            $leftPos = rand(0, 100); $duration = rand(18, 35); $delay = rand(0, 20); $size = rand(15, 35);
        @endphp
        <div class="leaf" style="color: {{ $randomColor }}; left: {{ $leftPos }}%; animation-duration: {{ $duration }}s; animation-delay: -{{ $delay }}s; font-size: {{ $size }}px;">
            <i class="fas fa-leaf"></i>
        </div>
    @endfor
</div>

<div class="container-fluid p-0 overflow-hidden position-relative z-2 main-register-container">
    <div class="row g-0 min-vh-100 shadow-lg">
        
        <div class="col-lg-5 d-none d-lg-flex flex-column align-items-center justify-content-center bg-gradient-nature-premium text-white p-5 position-relative overflow-hidden side-panel-premium">
            <div class="palm-pattern-overlay"></div>
            
            <div class="position-relative z-2 text-center mb-5 animate-fade-down">
                <div class="icon-brand-glow mb-4">
                    <i class="fas fa-shield-alt fa-3x text-white"></i>
                </div>
                <h2 class="fw-bolder display-6 mb-3 text-shadow-sm">Area Wajib Registrasi</h2>
                <p class="lead opacity-90 fw-medium text-shadow-sm" style="max-width: 80%;">Bergabunglah sekarang untuk akses penuh ke sistem pengelolaan cerdas.</p>
            </div>

            <div class="security-mascot-tough position-relative z-2 mt-2 animate-float-tough">
                <div class="speech-bubble-tough fw-bolder text-uppercase">
                    <i class="fas fa-hand-paper me-2 text-danger"></i> BERHENTI! Tunjukkan Identitas!
                </div>

                <div class="css-tough-character">
                    <div class="tough-cap">
                        <div class="cap-badge"><i class="fas fa-star"></i></div>
                    </div>
                    <div class="aviator-glasses">
                        <div class="glass left"></div><div class="glass right"></div>
                        <div class="bridge"></div>
                    </div>

                    <div class="character-body-tough">
                        <div class="tactical-vest">
                            <div class="vest-badge"><i class="fas fa-shield-alt"></i> POLISI SAWIT</div>
                            <div class="pocket left"></div><div class="pocket right"></div>
                        </div>
                        <div class="mustache-tough"></div>
                    </div>

                    <div class="hand-stop">
                        <div class="palm"></div>
                        <div class="thumb"></div>
                    </div>
                    
                    <div class="shadow-tough"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 d-flex align-items-center justify-content-center py-5 px-4 px-md-5 bg-form-premium position-relative">
             <div class="form-bg-pattern"></div>

            <div class="register-card-wrapper w-100 animate-fade-up position-relative z-2" style="max-width: 520px;">
                
                <div class="text-center mb-5">
                    <div class="d-inline-flex align-items-center justify-content-center mb-3 bg-white rounded-circle shadow-sm p-3">
                        <i class="fas fa-user-plus fa-2x text-success"></i>
                    </div>
                    <h3 class="fw-bolder text-dark">Buat Akun Baru</h3>
                    <p class="text-secondary fw-medium">Lengkapi data diri Anda dengan benar.</p>
                </div>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold small text-uppercase ls-1 text-secondary ps-3">Nama Lengkap</label>
                        <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden border-0 transition-all group-glass">
                            <span class="input-group-text border-0 ps-4"><i class="far fa-user text-muted"></i></span>
                            <input type="text" name="name" class="form-control border-0 ps-3 fw-medium" placeholder="Nama Anda" value="{{ old('name') }}" required>
                        </div>
                        @error('name') <small class="text-danger fw-bold ms-3 mt-1 d-block">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label fw-bold small text-uppercase ls-1 text-secondary ps-3">Alamat Email</label>
                        <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden border-0 transition-all group-glass">
                            <span class="input-group-text border-0 ps-4"><i class="far fa-envelope text-muted"></i></span>
                            <input type="email" name="email" class="form-control border-0 ps-3 fw-medium" placeholder="email@contoh.com" value="{{ old('email') }}" required>
                        </div>
                        @error('email') <small class="text-danger fw-bold ms-3 mt-1 d-block">{{ $message }}</small> @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                             <label class="form-label fw-bold small text-uppercase ls-1 text-secondary ps-3">Password</label>
                            <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden border-0 transition-all group-glass">
                                <span class="input-group-text border-0 ps-4"><i class="fas fa-lock text-muted"></i></span>
                                <input type="password" name="password" class="form-control border-0 ps-3 fw-medium" placeholder="Min. 8 karakter" required>
                            </div>
                             @error('password') <small class="text-danger fw-bold ms-3 mt-1 d-block">{{ $message }}</small> @enderror
                        </div>
                         <div class="col-md-6">
                             <label class="form-label fw-bold small text-uppercase ls-1 text-secondary ps-3">Ulangi Password</label>
                            <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden border-0 transition-all group-glass">
                                <span class="input-group-text border-0 ps-4"><i class="fas fa-lock-open text-muted"></i></span>
                                <input type="password" name="password_confirmation" class="form-control border-0 ps-3 fw-medium" placeholder="Konfirmasi" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-gradient-premium btn-lg w-100 rounded-pill fw-bold shadow-lg hover-scale position-relative overflow-hidden py-3">
                        <span class="position-relative z-2 d-flex align-items-center justify-content-center gap-2">
                            DAFTAR SEKARANG <i class="fas fa-arrow-right"></i>
                        </span>
                        <div class="shine-effect"></div>
                    </button>

                    <div class="text-center mt-4 fw-medium p-3 rounded-pill bg-white shadow-sm" style="max-width: 300px; margin: 20px auto 0;">
                        Sudah punya akun? <a href="{{ route('login') }}" class="text-success fw-bolder text-decoration-none hover-underline">Masuk disini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* --- PERBAIKAN PENTING: POSISI DAUN JATUH --- */
    .falling-leaves-container {
        position: fixed; /* Wajib Fixed agar tidak dorong konten */
        top: 0; left: 0; width: 100vw; height: 100vh;
        z-index: 0; /* Di belakang layar */
        pointer-events: none; overflow: hidden;
    }
    .leaf { position: absolute; top: -10%; animation: fall linear infinite; }
    @keyframes fall { 
        0% { transform: translateY(-10vh) rotate(0deg); opacity: 0; } 
        100% { transform: translateY(110vh) rotate(360deg); opacity: 0; } 
    }
    .falling-leaves-container.premium-leaves { opacity: 0.15; }
    .premium-leaves .leaf i { filter: drop-shadow(0 0 5px rgba(255,255,255,0.2)); }

    /* --- LAYOUT PREMIUM --- */
    .bg-gradient-nature-premium { background: linear-gradient(160deg, #1B5E20 0%, #2E7D32 50%, #004D40 100%); }
    .bg-form-premium { background-color: #F8F9FA; /* Off-white */ }
    .text-shadow-sm { text-shadow: 0 2px 4px rgba(0,0,0,0.2); }
    
    /* Pattern Overlay Halus */
    .palm-pattern-overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; z-index: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 50c0-11.046 8.954-20 20-20s20 8.954 20 20-8.954 20-20 20-20-8.954-20-20z' fill='%23ffffff' fill-opacity='1' fill-rule='evenodd'/%3E%3C/svg%3E"); 
        background-size: 60px 60px;
        mask-image: linear-gradient(to bottom, rgba(0,0,0,1), rgba(0,0,0,0)); 
    }
    .form-bg-pattern {
         position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.03; z-index: 0;
         background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23000000' fill-opacity='1' fill-rule='evenodd'%3E%3Ccircle cx='3' cy='3' r='3'/%3E%3Ccircle cx='13' cy='13' r='3'/%3E%3C/g%3E%3C/svg%3E");
    }

    .icon-brand-glow {
        display: inline-block; padding: 20px; background: rgba(255,255,255,0.15); border-radius: 50%;
        backdrop-filter: blur(10px); box-shadow: 0 0 30px rgba(255,255,255,0.2), inset 0 0 10px rgba(255,255,255,0.1);
        animation: pulse-glow 3s infinite;
    }
    @keyframes pulse-glow { 0%, 100% { box-shadow: 0 0 30px rgba(255,255,255,0.2); } 50% { box-shadow: 0 0 50px rgba(255,255,255,0.4); } }


    /* --- FORM & TOMBOL PREMIUM --- */
    .group-glass {
        background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px);
        border: 1px solid rgba(0,0,0,0.05) !important;
    }
    .group-glass:focus-within {
        background: #fff !important; border-color: #2E7D32 !important;
        box-shadow: 0 5px 15px rgba(46, 125, 50, 0.15) !important; transform: translateY(-2px);
    }
    .group-glass .input-group-text, .group-glass .form-control { background: transparent !important; }
    .group-glass:focus-within .input-group-text i { color: #2E7D32 !important; }

    .btn-gradient-premium {
        background: linear-gradient(135deg, #2E7D32, #1B5E20, #004D40); background-size: 200% auto;
        border: none; color: white !important; letter-spacing: 1px;
    }
    .btn-gradient-premium:hover {
        background-position: right center; box-shadow: 0 15px 30px rgba(27, 94, 32, 0.6) !important;
    }
    .ls-1 { letter-spacing: 1px; } .hover-underline:hover { text-decoration: underline !important; }

    /* --- MASKOT SECURITY SANGAR (CSS MURNI) --- */
    .security-mascot-tough { position: relative; width: 220px; height: 220px; margin-top: 30px; }
    
    /* Balon Bicara Tegas */
    .speech-bubble-tough {
        position: absolute; top: -70px; right: -40px; background: #D32F2F; color: #fff;
        padding: 12px 25px; border-radius: 8px; font-size: 0.85rem; font-weight: 800; letter-spacing: 0.5px;
        box-shadow: 5px 5px 0px #8E0000; transform: rotate(-5deg); z-index: 10;
        animation: popInTough 0.6s cubic-bezier(0.68, -0.55, 0.27, 1.55) 0.5s both;
    }
    .speech-bubble-tough::after {
        content: ''; position: absolute; bottom: -15px; left: 30px;
        border-width: 15px 15px 0; border-style: solid; border-color: #D32F2F transparent; transform: rotate(5deg);
    }

    /* Karakter Utama */
    .css-tough-character { position: relative; width: 100%; height: 100%; }
    
    /* Badan Kekar & Bertekstur */
    .character-body-tough {
        width: 160px; height: 170px;
        background: linear-gradient(135deg, #E65100, #BF360C); /* Oranye gelap */
        border-radius: 40% 40% 50% 50% / 50% 50% 45% 45%;
        position: absolute; bottom: 10px; left: 30px; z-index: 2;
        box-shadow: inset -10px -10px 25px rgba(0,0,0,0.5), inset 5px 5px 10px rgba(255,255,255,0.2);
        overflow: hidden;
    }

    /* Rompi Taktis (Vest) */
    .tactical-vest {
        position: absolute; bottom: 0; left: 0; width: 100%; height: 70%;
        background: #263238; /* Abu gelap */
        border-radius: 0 0 50% 50% / 0 0 45% 45%; z-index: 3;
        border-top: 4px solid #455A64;
    }
    .vest-badge {
        position: absolute; top: 10px; left: 50%; transform: translateX(-50%);
        color: #FFD54F; font-size: 0.7rem; font-weight: bold; text-transform: uppercase;
        text-shadow: 0 1px 2px rgba(0,0,0,0.5); display: flex; align-items: center; gap: 5px;
    }
    .pocket { width: 35px; height: 30px; background: #37474F; position: absolute; bottom: 20px; border-radius: 4px; border: 2px solid #455A64; }
    .pocket.left { left: 25px; } .pocket.right { right: 25px; }

    /* Topi Polisi Sangar */
    .tough-cap {
        width: 120px; height: 45px; background: #0D47A1; border-radius: 15px 15px 5px 5px;
        position: absolute; top: -20px; left: 50px; z-index: 5;
        box-shadow: 0 5px 10px rgba(0,0,0,0.3); border-bottom: 5px solid #FFD54F;
    }
    .tough-cap::before { /* Visor/Moncong Topi */
        content: ''; position: absolute; bottom: -5px; left: 10%; width: 80%; height: 15px;
        background: #0D47A1; border-radius: 50%; z-index: -1; box-shadow: 0 5px 5px rgba(0,0,0,0.4);
    }
    .cap-badge {
        position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%);
        color: #FFD54F; font-size: 1.2rem; filter: drop-shadow(0 2px 2px rgba(0,0,0,0.5));
    }

    /* Kacamata Aviator (Kunci Kesangaran) */
    .aviator-glasses {
        position: absolute; top: 40px; left: 50%; transform: translateX(-50%); z-index: 5;
        width: 100px; height: 40px; display: flex; justify-content: center; align-items: center;
    }
    .glass {
        width: 45px; height: 45px; background: linear-gradient(135deg, #1c1c1c, #424242);
        border-radius: 50%; border: 3px solid #FFD54F; /* Frame emas */
        position: relative; overflow: hidden;
    }
    .glass::after { /* Kilatan di kacamata */
        content: ''; position: absolute; top: 5px; left: 5px; width: 20px; height: 10px;
        background: rgba(255,255,255,0.4); border-radius: 50%; transform: rotate(-30deg);
    }
    .bridge { position: absolute; width: 20px; height: 3px; background: #FFD54F; top: 20px; }
    
    /* Kumis Tebal */
    .mustache-tough {
        width: 70px; height: 20px; border-top: 8px solid #212121; border-radius: 50% 50% 0 0;
        position: absolute; bottom: 100px; left: 50%; transform: translateX(-50%) rotate(-5deg); z-index: 5;
    }

    /* Tangan STOP (Besar & Tegas) */
    .hand-stop {
        position: absolute; right: -30px; top: 70px; z-index: 10;
        transform: scale(1.2); animation: stopMotion 0.8s infinite alternate ease-in-out;
    }
    .palm {
        width: 50px; height: 60px; background: #E65100; border-radius: 30% 30% 10% 10%;
        border: 3px solid #BF360C; box-shadow: 5px 5px 15px rgba(0,0,0,0.3);
    }
    .thumb {
        position: absolute; left: -15px; bottom: 5px; width: 20px; height: 35px;
        background: #E65100; border-radius: 10px; border: 3px solid #BF360C; transform: rotate(-45deg);
    }

    .shadow-tough {
        width: 140px; height: 25px; background: rgba(0,0,0,0.4); filter: blur(5px);
        border-radius: 50%; position: absolute; bottom: -5px; left: 40px; z-index: 0;
    }

    /* Animasi Sangar */
    .animate-float-tough { animation: floatingTough 4s ease-in-out infinite; }
    @keyframes floatingTough { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-15px); } }
    @keyframes stopMotion { from { transform: scale(1.2) translateX(0); } to { transform: scale(1.3) translateX(5px); } }
    @keyframes popInTough { 0% { opacity: 0; transform: scale(0.5) rotate(-5deg) translateY(30px); } 100% { opacity: 1; transform: scale(1) rotate(-5deg) translateY(0); } }

    /* Utils */
    .shine-effect { position: absolute; top: 0; left: -100%; width: 50%; height: 100%; background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%); transform: skewX(-25deg); animation: shine 3s infinite; }
    .hover-scale:hover { transform: scale(1.02); }
    .animate-fade-up { animation: fadeInUp 0.8s forwards; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-down { animation: fadeInDown 0.8s forwards; }
    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-30px); } to { opacity: 1; transform: translateY(0); } }

    /* Responsif */
    @media (max-width: 991px) {
        .side-panel-premium { padding: 3rem !important; min-height: 40vh; }
        .security-mascot-tough { transform: scale(0.8); margin-top: 10px; }
        .speech-bubble-tough { top: -80px; right: -10px; font-size: 0.75rem; }
    }
</style>
@endsection