@extends('layouts.guest.app')

@section('title', 'Login - SawitKu')

@section('content')

<div class="luxury-wrapper container-fluid p-0 overflow-hidden">
    <div class="row g-0 min-vh-100">
        
        {{-- BAGIAN KIRI (MASKOT & BACKGROUND HIJAU) --}}
        <div class="col-lg-5 d-none d-lg-flex flex-column align-items-center justify-content-center position-relative overflow-hidden bg-luxury-green text-white">
            
            <div class="pattern-overlay"></div>
            <div class="glow-center"></div>

            <div class="position-relative z-2 text-center px-5">
                <div class="brand-badge mb-4 animate-fade-down">
                    <i class="fas fa-leaf text-warning me-2"></i> SMART PLANTATION SYSTEM
                </div>
                <h1 class="display-5 fw-bold mb-3">Selamat Datang.</h1>
                <p class="lead fw-light opacity-80 mb-5">Kelola hasil panen dengan presisi dan teknologi terkini.</p>

                <div class="mascot-stage floating-slow">
                    <div class="mascot-body-smart">
                        <div class="face-visor">
                            <div class="eye-pixel left"></div>
                            <div class="eye-pixel right"></div>
                            <div class="mouth-line"></div>
                        </div>
                        <div class="body-shell">
                            <div class="core-light"></div>
                        </div>
                        <div class="hand-smart left"></div>
                        <div class="hand-smart right"></div>
                    </div>
                    <div class="platform-shadow"></div>
                </div>
            </div>
        </div>

        {{-- BAGIAN KANAN (FORM LOGIN) --}}
        <div class="col-lg-7 d-flex align-items-center justify-content-center bg-white position-relative">
            <div class="form-container w-100 px-4 px-sm-5 animate-fade-up" style="max-width: 500px;">
                
                <div class="mb-5">
                    <h3 class="fw-bold text-dark mb-2">Masuk ke Akun</h3>
                    <p class="text-muted">Lanjutkan aktivitas pemantauan kebun Anda.</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger-soft mb-4 d-flex align-items-center">
                        <i class="fas fa-exclamation-circle fs-5 me-3"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control form-control-luxury" id="emailInput" placeholder="Email" value="{{ old('email') }}" required>
                        <label for="emailInput">Alamat Email</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" name="password" class="form-control form-control-luxury" id="passInput" placeholder="Password" required>
                        <label for="passInput">Password</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label text-muted small" for="remember">Ingat Saya</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="small text-success fw-bold text-decoration-none hover-underline">Lupa Password?</a>
                    </div>

                    {{-- TOMBOL LOGIN UTAMA --}}
                    <button type="submit" class="btn btn-emerald-gradient w-100 py-3 mb-4 shadow-lg">
                        <span class="position-relative z-2">MASUK DASHBOARD <i class="fas fa-arrow-right ms-2"></i></span>
                    </button>

                    {{-- === BAGIAN BARU: DIVIDER & TOMBOL GOOGLE === --}}
                    <div class="d-flex align-items-center mb-4">
                        <hr class="flex-grow-1 border-secondary opacity-10">
                        <span class="mx-3 text-muted x-small fw-bold">ATAU</span>
                        <hr class="flex-grow-1 border-secondary opacity-10">
                    </div>

                    <a href="{{ route('redirect.google') }}" class="btn btn-google-luxury w-100 py-3 mb-4">
                        <i class="fab fa-google text-danger fs-5"></i>
                        <span>Masuk dengan Google</span>
                    </a>
                    {{-- === END BAGIAN BARU === --}}

                    <p class="text-center text-muted small">
                        Belum punya akun? <a href="{{ route('register') }}" class="text-success fw-bold text-decoration-none">Daftar Disini</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* --- THEME VARIABLES --- */
    :root {
        --emerald-dark: #064e3b;
        --emerald-main: #10b981;
        --gold: #fbbf24;
    }

    /* --- BACKGROUND FIX (NO GLITCH) --- */
    .bg-luxury-green {
        background: radial-gradient(circle at center, #065f46 0%, #022c22 100%);
        position: relative;
    }
    .pattern-overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background-image: radial-gradient(rgba(255,255,255,0.05) 1px, transparent 1px);
        background-size: 30px 30px; opacity: 0.5;
    }
    .glow-center {
        position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.2) 0%, transparent 70%);
        pointer-events: none;
    }

    /* --- UI ELEMENTS --- */
    .brand-badge {
        display: inline-block; padding: 8px 16px; border-radius: 50px;
        background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);
        font-size: 0.7rem; letter-spacing: 2px; font-weight: 700; color: #fff;
    }

    /* Form Styling */
    .form-control-luxury {
        border: 1px solid #e5e7eb; border-radius: 12px; background: #f9fafb;
        height: 58px; padding-left: 20px; font-weight: 500; transition: all 0.3s;
    }
    .form-control-luxury:focus {
        background: #fff; border-color: var(--emerald-main);
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
    }
    
    /* Mode Gelap Form */
    [data-theme="dark"] .bg-white { background-color: #0f172a !important; }
    [data-theme="dark"] .text-dark { color: #fff !important; }
    [data-theme="dark"] .text-muted { color: #94a3b8 !important; }
    [data-theme="dark"] .form-control-luxury { background: #1e293b; border-color: #334155; color: #fff; }
    [data-theme="dark"] .form-control-luxury:focus { border-color: var(--emerald-main); }

    /* Button Emerald */
    .btn-emerald-gradient {
        background: linear-gradient(135deg, #059669, #047857);
        border: none; color: white; font-weight: 700; letter-spacing: 1px;
        border-radius: 12px; transition: all 0.3s;
    }
    .btn-emerald-gradient:hover {
        background: linear-gradient(135deg, #10b981, #059669);
        transform: translateY(-2px); box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4);
    }

    /* === NEW BUTTON: GOOGLE LUXURY === */
    .btn-google-luxury {
        background: #fff; border: 1px solid #e5e7eb; color: #374151;
        font-weight: 600; border-radius: 12px; transition: all 0.3s;
        display: flex; align-items: center; justify-content: center; gap: 10px;
    }
    .btn-google-luxury:hover {
        background: #f9fafb; border-color: #d1d5db;
        transform: translateY(-2px); box-shadow: 0 5px 15px -5px rgba(0, 0, 0, 0.05);
    }
    [data-theme="dark"] .btn-google-luxury {
        background: #1e293b; border-color: #334155; color: #fff;
    }
    [data-theme="dark"] .btn-google-luxury:hover {
        background: #334155;
    }
    
    /* Alert */
    .alert-danger-soft { background: #fef2f2; color: #991b1b; border: 1px solid #fee2e2; border-radius: 10px; padding: 15px; }
    [data-theme="dark"] .alert-danger-soft { background: rgba(153, 27, 27, 0.2); border-color: rgba(153, 27, 27, 0.3); color: #fca5a5; }

    /* --- MASKOT: SMART ASSISTANT (GREEN) --- */
    .mascot-stage { position: relative; width: 180px; height: 180px; margin: 0 auto; }
    .floating-slow { animation: float 6s ease-in-out infinite; }

    .mascot-body-smart {
        width: 120px; height: 140px; position: absolute; left: 50%; bottom: 30px;
        transform: translateX(-50%); border-radius: 45% 45% 50% 50%;
        background: linear-gradient(145deg, #ffffff, #e6e6e6);
        box-shadow: inset -5px -5px 15px rgba(0,0,0,0.1); z-index: 2;
    }

    .face-visor {
        position: absolute; top: 35px; left: 50%; transform: translateX(-50%);
        width: 80px; height: 45px; background: #022c22; border-radius: 20px;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        border: 2px solid #34d399; box-shadow: 0 0 15px rgba(52, 211, 153, 0.3);
    }
    .eye-pixel { width: 8px; height: 8px; background: #34d399; border-radius: 2px; animation: blink 3s infinite; box-shadow: 0 0 5px #34d399; }
    .mouth-line { position: absolute; bottom: 10px; width: 20px; height: 2px; background: #34d399; border-radius: 2px; }

    .body-shell {
        position: absolute; bottom: 0; width: 100%; height: 40%;
        background: #064e3b; border-radius: 0 0 50% 50%;
    }
    .core-light {
        position: absolute; top: -10px; left: 50%; transform: translateX(-50%);
        width: 20px; height: 20px; background: #fbbf24; border-radius: 50%;
        border: 3px solid #fff; box-shadow: 0 0 15px #fbbf24;
    }

    .hand-smart {
        width: 25px; height: 30px; background: #fff; border-radius: 12px;
        position: absolute; top: 70px; box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    }
    .hand-smart.left { left: -15px; transform: rotate(-20deg); }
    .hand-smart.right { right: -15px; transform: rotate(20deg); }

    .platform-shadow {
        position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);
        width: 100px; height: 10px; background: rgba(0,0,0,0.3); border-radius: 50%;
        filter: blur(5px); z-index: 1; animation: shadowPulse 6s ease-in-out infinite;
    }

    /* Animasi */
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }
    @keyframes shadowPulse { 0%, 100% { transform: translateX(-50%) scale(1); opacity: 0.3; } 50% { transform: translateX(-50%) scale(0.8); opacity: 0.1; } }
    @keyframes blink { 0%, 96%, 100% { transform: scaleY(1); } 98% { transform: scaleY(0.1); } }
    .animate-fade-down { animation: fadeDown 1s both; }
    .animate-fade-up { animation: fadeUp 1s both; }
    @keyframes fadeDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    
    .x-small { font-size: 0.75rem; }

</style>
@endsection