@extends('layouts.guest.app')

@section('title', 'Buat Password Baru')

@section('content')
<div class="container-fluid p-0 overflow-hidden bg-white">
    <div class="row g-0 min-vh-100">
        <div class="col-lg-6 d-none d-lg-flex flex-column align-items-center justify-content-center bg-gradient-nature text-white p-5">
            <div class="modern-pattern opacity-10"></div>
            
            <div class="text-center position-relative z-2">
                <div class="mb-4 animate-pulse">
                    <i class="fas fa-shield-alt fa-4x text-white"></i>
                </div>
                <h2 class="fw-bold display-6">Amankan Akun Anda</h2>
                <p class="lead opacity-75">Buat password baru yang kuat dan mudah diingat.</p>
                
                <div class="mascot-container mt-5">
                    <div class="mascot-body-ready">
                        <div class="shield-icon"><i class="fas fa-check"></i></div>
                        <div class="face-ready">
                            <div class="eye left"></div><div class="eye right"></div>
                            <div class="mouth-smile"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 d-flex align-items-center justify-content-center py-5 px-4 bg-white">
            <div class="w-100 animate-fade-up" style="max-width: 450px;">
                <div class="mb-5">
                    <h3 class="fw-bold text-dark">Password Baru</h3>
                    <p class="text-muted small">Silahkan masukkan password baru Anda.</p>
                </div>

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group mb-3">
                        <label class="form-label fw-bold small text-muted ls-1">EMAIL</label>
                        <input type="email" name="email" class="form-control bg-light border-0 py-3 ps-3" value="{{ $email }}" readonly style="cursor: not-allowed; opacity: 0.7;">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw-bold small text-muted ls-1">PASSWORD BARU</label>
                        <input type="password" name="password" class="form-control bg-light border-0 py-3 ps-3" placeholder="Minimal 8 karakter" required autofocus>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label fw-bold small text-muted ls-1">ULANGI PASSWORD</label>
                        <input type="password" name="password_confirmation" class="form-control bg-light border-0 py-3 ps-3" placeholder="Ketik ulang password" required>
                    </div>

                    <button type="submit" class="btn btn-gradient-success w-100 py-3 rounded-pill fw-bold shadow-lg hover-scale">
                        Simpan Password Baru
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-nature { background: linear-gradient(135deg, #2E7D32 0%, #66BB6A 100%); }
    .btn-gradient-success { background: linear-gradient(135deg, #2E7D32, #43A047); color: white; border: none; }
    .btn-gradient-success:hover { box-shadow: 0 10px 20px rgba(46, 125, 50, 0.3); transform: translateY(-3px); color: white; }

    /* Maskot Ready */
    .mascot-body-ready {
        width: 120px; height: 140px; background: #43A047; border-radius: 40px; margin: 0 auto; position: relative;
        box-shadow: inset -5px -5px 15px rgba(0,0,0,0.2); animation: float 4s infinite ease-in-out;
        border: 4px solid #fff;
    }
    .shield-icon {
        position: absolute; top: -20px; right: -10px; width: 40px; height: 40px; background: #FFC107;
        border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #333; font-weight: bold;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2); animation: pulse 2s infinite;
    }
    .face-ready { position: absolute; top: 45px; width: 100%; text-align: center; }
    .eye { width: 12px; height: 12px; background: #fff; border-radius: 50%; display: inline-block; margin: 0 15px; }
    .mouth-smile { width: 30px; height: 15px; border-bottom: 3px solid #fff; border-radius: 0 0 20px 20px; margin: 5px auto; }
    
    @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.1); } 100% { transform: scale(1); } }
    .hover-scale:hover { transform: scale(1.02); transition: 0.3s; }
</style>
@endsection