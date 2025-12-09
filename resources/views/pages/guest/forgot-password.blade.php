@extends('layouts.guest.app')

@section('title', 'Lupa Password')

@section('content')
<div class="container-fluid p-0 overflow-hidden bg-white">
    <div class="row g-0 min-vh-100">
        <div class="col-lg-6 d-none d-lg-flex flex-column align-items-center justify-content-center bg-gradient-nature text-white p-5 position-relative">
            <div class="modern-pattern opacity-10"></div>
            
            <div class="text-center position-relative z-2">
                <div class="mb-4 animate-bounce-slow">
                    <i class="fas fa-key fa-4x text-warning"></i>
                </div>
                <h2 class="fw-bold display-6">Lupa Password?</h2>
                <p class="lead opacity-75">Jangan khawatir, kami akan membantu Anda<br>mendapatkan kembali akses akun.</p>
                
                <div class="mascot-container mt-5">
                    <div class="mascot-body-confused">
                        <div class="face-confused">
                            <div class="eye left"></div><div class="eye right"></div>
                            <div class="mouth-confused"></div>
                        </div>
                        <div class="sweat-drop"></div> <div class="question-mark">?</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 d-flex align-items-center justify-content-center py-5 px-4 bg-white">
            <div class="w-100 animate-fade-up" style="max-width: 450px;">
                <div class="mb-4">
                    <h3 class="fw-bold text-dark">Reset Password</h3>
                    <p class="text-muted small">Masukkan email yang terdaftar untuk menerima link reset.</p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success border-0 shadow-sm mb-4">
                        <i class="fas fa-paper-plane me-2"></i> {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold small text-muted ls-1">EMAIL ANDA</label>
                        <div class="input-group input-group-lg shadow-sm rounded-pill border-0 bg-light overflow-hidden">
                            <span class="input-group-text border-0 bg-transparent ps-4"><i class="far fa-envelope text-muted"></i></span>
                            <input type="email" name="email" class="form-control border-0 bg-transparent ps-2" placeholder="contoh@email.com" required>
                        </div>
                        @error('email') <small class="text-danger fw-bold ms-3">{{ $message }}</small> @enderror
                    </div>

                    <button type="submit" class="btn btn-gradient-success w-100 py-3 rounded-pill fw-bold shadow-lg hover-scale">
                        Kirim Link Reset <i class="fas fa-arrow-right ms-2"></i>
                    </button>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-muted text-decoration-none small fw-bold hover-text-success">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Utils sama dengan Login */
    .bg-gradient-nature { background: linear-gradient(135deg, #2E7D32 0%, #66BB6A 100%); }
    .modern-pattern { position: absolute; width: 100%; height: 100%; background-image: radial-gradient(rgba(255,255,255,0.2) 1px, transparent 1px); background-size: 20px 20px; }
    .btn-gradient-success { background: linear-gradient(135deg, #2E7D32, #43A047); color: white; border: none; }
    .btn-gradient-success:hover { box-shadow: 0 10px 20px rgba(46, 125, 50, 0.3); transform: translateY(-3px); color: white; }
    
    /* Maskot Bingung */
    .mascot-body-confused {
        width: 120px; height: 140px; background: #8BC34A; border-radius: 50px; margin: 0 auto; position: relative;
        box-shadow: inset -5px -5px 15px rgba(0,0,0,0.2); animation: float 4s infinite ease-in-out;
    }
    .face-confused { position: absolute; top: 40px; left: 50%; transform: translateX(-50%); width: 100%; }
    .eye { width: 15px; height: 15px; background: #1c1c1c; border-radius: 50%; position: absolute; top: 0; }
    .eye.left { left: 30px; height: 12px; } /* Mata kiri agak sipit */
    .eye.right { right: 30px; }
    .mouth-confused {
        width: 20px; height: 20px; border: 3px solid #1c1c1c; border-radius: 50%;
        position: absolute; top: 25px; left: 50%; transform: translateX(-50%);
    }
    .sweat-drop {
        width: 10px; height: 15px; background: #4FC3F7; border-radius: 0 50% 50% 50%;
        position: absolute; top: 20px; right: 15px; animation: drip 2s infinite;
    }
    .question-mark {
        position: absolute; top: -40px; right: -20px; font-size: 4rem; font-weight: bold; color: #FFEB3B;
        animation: bounce 2s infinite; filter: drop-shadow(0 2px 5px rgba(0,0,0,0.2));
    }
    
    @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    @keyframes drip { 0% { opacity: 0; transform: translateY(0); } 50% { opacity: 1; } 100% { transform: translateY(20px); opacity: 0; } }
    @keyframes bounce { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    .hover-scale:hover { transform: scale(1.02); transition: 0.3s; }
</style>
@endsection