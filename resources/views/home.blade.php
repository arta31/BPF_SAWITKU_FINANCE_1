@extends('layouts.guest.app')

@section('title', 'Selamat Datang')

@section('content')

{{-- 1. BACKGROUND DAUN JATUH GLOWING --}}
<div class="falling-leaves-container">
    @for ($i = 0; $i < 25; $i++)
        @php
            $colors = ['#4CAF50', '#8BC34A', '#FFC107', '#AED581'];
            $randomColor = $colors[array_rand($colors)];
            $leftPos = rand(0, 100); 
            $duration = rand(15, 30);
            $delay = rand(0, 15);
            $size = rand(20, 40);
        @endphp
        <div class="leaf" style="
            color: {{ $randomColor }};
            left: {{ $leftPos }}%;
            animation-duration: {{ $duration }}s;
            animation-delay: -{{ $delay }}s;
            font-size: {{ $size }}px;
            opacity: 0.6;
            text-shadow: 0 0 10px {{ $randomColor }};
        ">
            <i class="fas fa-leaf"></i>
        </div>
    @endfor
</div>

{{-- 2. KONTEN UTAMA (HERO SECTION) --}}
<div class="hero-section d-flex align-items-center justify-content-center position-relative overflow-hidden" style="min-height: 100vh;">
    
    <div class="container text-center position-relative z-2">
        
        <div class="mb-4 animate-fade-down">
            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-lg p-4 position-relative" style="width: 100px; height: 100px;">
                <div class="position-absolute w-100 h-100 rounded-circle bg-success opacity-25 animate-pulse" style="z-index: -1;"></div>
                <i class="fas fa-seedling fa-3x text-success"></i>
            </div>
        </div>

        <h1 class="display-4 fw-bolder mb-3 animate-zoom-in text-dark">
            Selamat Datang di <span class="text-success position-relative">SawitKu
                <svg class="position-absolute bottom-0 start-0 w-100 text-success opacity-50" height="10" viewBox="0 0 100 10" preserveAspectRatio="none" style="z-index: -1;">
                    <path d="M0,5 Q50,10 100,5" stroke="currentColor" stroke-width="3" fill="none" />
                </svg>
            </span>
        </h1>
        
        <p class="lead text-secondary mb-5 mx-auto animate-fade-up" style="max-width: 600px;">
            Solusi Cerdas Petani Modern. Kelola Panen, Pantau Keuangan, dan Raih Keuntungan Maksimal.
        </p>

        <div class="d-flex flex-wrap justify-content-center gap-3 mb-5 animate-fade-up" style="animation-delay: 0.2s;">
            @auth
                <a href="{{ route('guest.dashboard') }}" class="btn btn-custom-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg position-relative overflow-hidden">
                    <span class="btn-content position-relative z-2">
                        <i class="fas fa-columns me-2 icon-move"></i> Ke Dashboard
                    </span>
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-custom-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg position-relative overflow-hidden">
                    <span class="btn-content position-relative z-2">
                        <i class="fas fa-sign-in-alt me-2 icon-slide"></i> Masuk Sekarang
                    </span>
                    <div class="shine-anim"></div>
                </a>

                <a href="{{ route('register') }}" class="btn btn-custom-outline btn-lg rounded-pill px-5 py-3 fw-bold shadow-sm position-relative overflow-hidden">
                    <span class="btn-content position-relative z-2">
                        <i class="fas fa-user-plus me-2 icon-jump"></i> Daftar Akun
                    </span>
                    <div class="hover-fill"></div>
                </a>
            @endauth
        </div>

        <div class="row justify-content-center g-4 animate-fade-up" style="animation-delay: 0.4s;">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-5 h-100 hover-lift-sm glass-card p-4 text-center card-feature">
                    <div class="icon-glow icon-glow-success mx-auto mb-4"><i class="fas fa-edit fa-2x"></i></div>
                    <h5 class="fw-bold text-dark mb-2">Catat Mudah</h5>
                    <p class="text-secondary small mb-0">Input data panen semudah kirim pesan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-5 h-100 hover-lift-sm glass-card p-4 text-center card-feature">
                    <div class="icon-glow icon-glow-warning mx-auto mb-4"><i class="fas fa-chart-pie fa-2x"></i></div>
                    <h5 class="fw-bold text-dark mb-2">Laporan Jelas</h5>
                    <p class="text-secondary small mb-0">Grafik keuntungan otomatis tanpa ribet.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-5 h-100 hover-lift-sm glass-card p-4 text-center card-feature">
                    <div class="icon-glow icon-glow-primary mx-auto mb-4"><i class="fas fa-shield-alt fa-2x"></i></div>
                    <h5 class="fw-bold text-dark mb-2">Data Aman</h5>
                    <p class="text-secondary small mb-0">Data tersimpan aman di sistem cloud.</p>
                </div>
            </div>
        </div>

    </div>

    {{-- 3. MASKOT INTERAKTIF --}}
    <div class="mascot-wrapper fixed-bottom-left animate-slide-in-left" id="mascotArea">
        <div class="mascot-bubble">
            <div class="bubble-content">
                <span class="wave-emoji" id="bubbleIcon">👋</span>
                <p class="mb-0 lh-sm" id="bubbleText" style="font-size: 0.9rem;">
                    Halo! Selamat Datang di <br><strong class="text-success">SawitKu!</strong> 🌱
                </p>
            </div>
            <div class="bubble-arrow"></div>
        </div>
    
        <div class="css-character floating-animate" id="characterBody">
            <div class="leaf-hair"></div>
            
            <div class="character-body">
                <div class="face">
                    <div class="eye left"><div class="pupil" id="pupil-left"></div></div>
                    <div class="eye right"><div class="pupil" id="pupil-right"></div></div>
                    <div class="cheeks left"></div><div class="cheeks right"></div>
                    <div class="mouth" id="mascotMouth"></div>
                </div>
                <div class="hand-left" id="mascotHand"></div>
            </div>
            
            <div class="shadow-base"></div>
        </div>
    </div>

</div>

{{-- JAVASCRIPT INTERAKSI --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const characterBody = document.getElementById('characterBody');
        const mouth = document.getElementById('mascotMouth');
        const hand = document.getElementById('mascotHand');
        const bubbleText = document.getElementById('bubbleText');
        const bubbleIcon = document.getElementById('bubbleIcon');
        const pupilLeft = document.getElementById('pupil-left');
        const pupilRight = document.getElementById('pupil-right');

        // MATA MENGIKUTI KURSOR
        document.addEventListener('mousemove', (e) => {
            const movePupil = (pupil) => {
                const rect = pupil.getBoundingClientRect();
                const x = rect.left + rect.width / 2;
                const y = rect.top + rect.height / 2;
                const limit = 4;
                const dx = Math.min(Math.max((e.pageX - x) / 20, -limit), limit);
                const dy = Math.min(Math.max((e.pageY - y) / 20, -limit), limit);
                pupil.style.transform = `translate(${dx}px, ${dy}px)`;
            };
            if(pupilLeft && pupilRight) { movePupil(pupilLeft); movePupil(pupilRight); }
        });

        // KLIK MASKOT (BICARA)
        characterBody.addEventListener('click', function() {
            characterBody.classList.remove('floating-animate');
            const originalText = bubbleText.innerHTML;
            const userName = "{{ Auth::check() ? Auth::user()->name : 'User' }}";
            
            bubbleText.innerHTML = `Halo, <strong>${userName}!</strong> <br>Semangat panen ya! 🌾`;
            bubbleIcon.innerHTML = "🗣️";
            mouth.classList.add('talking');
            hand.classList.add('waving');
            characterBody.style.transform = "scale(1.1)";
            setTimeout(() => characterBody.style.transform = "scale(1)", 150);

            setTimeout(() => {
                bubbleText.innerHTML = originalText;
                bubbleIcon.innerHTML = "👋";
                mouth.classList.remove('talking');
                hand.classList.remove('waving');
                characterBody.classList.add('floating-animate');
            }, 3000);
        });
    });
</script>

<style>
    /* --- PERBAIKAN TOMBOL DAFTAR (MODE MALAM) --- */
    
    /* 1. Tombol Masuk (Full Warna) */
    .btn-custom-primary {
        background: linear-gradient(45deg, #2E7D32, #43A047, #66BB6A, #2E7D32);
        background-size: 300% 100%;
        border: none; color: white !important;
        transition: all 0.4s ease-in-out;
    }
    .btn-custom-primary:hover {
        background-position: 100% 0; transform: translateY(-5px) scale(1.02);
        box-shadow: 0 15px 30px rgba(46, 125, 50, 0.5) !important;
    }
    /* Ikon Geser */
    .icon-slide { display: inline-block; transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55); }
    .btn-custom-primary:hover .icon-slide { transform: translateX(5px); }
    /* Shine Effect */
    .shine-anim {
        position: absolute; top: 0; left: -100%; width: 50%; height: 100%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
        transform: skewX(-25deg); animation: shine-infinite 4s infinite;
    }
    @keyframes shine-infinite { 0% { left: -100%; } 20% { left: 200%; } 100% { left: 200%; } }

    /* 2. Tombol Daftar (Outline) - DIPERBAIKI */
    .btn-custom-outline {
        background: white; 
        color: #2E7D32 !important; 
        border: 2px solid #2E7D32;
        transition: all 0.3s ease; z-index: 1;
    }
    
    /* KHUSUS MODE MALAM: Paksa transparan dan teks putih/terang */
    [data-theme="dark"] .btn-custom-outline { 
        background: transparent !important; 
        border-color: #4CAF50 !important; 
        color: #4CAF50 !important; 
    }

    /* Animasi Isi (Swipe Fill) */
    .hover-fill {
        position: absolute; top: 0; left: 0; width: 0%; height: 100%;
        background: #2E7D32; transition: width 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        z-index: 1; border-radius: 50px;
    }
    .btn-custom-outline:hover .hover-fill { width: 100%; }
    
    /* Hover Text Color */
    .btn-custom-outline:hover { 
        color: white !important; /* Teks jadi putih saat hover */
        border-color: #2E7D32; 
        transform: translateY(-5px); 
        box-shadow: 0 10px 20px rgba(46, 125, 50, 0.3) !important; 
    }
    
    /* Hover di Mode Malam */
    [data-theme="dark"] .hover-fill { background: #4CAF50; }
    [data-theme="dark"] .btn-custom-outline:hover { border-color: #4CAF50; }

    /* Ikon Lompat */
    .icon-jump { display: inline-block; transition: transform 0.3s; }
    .btn-custom-outline:hover .icon-jump { animation: jumpIcon 0.5s ease; }
    @keyframes jumpIcon { 0% { transform: translateY(0); } 50% { transform: translateY(-5px) scale(1.2); } 100% { transform: translateY(0); } }


    /* --- MASKOT STYLE --- */
    .mascot-wrapper { position: fixed; bottom: 30px; left: 30px; z-index: 1050; display: flex; flex-direction: column; align-items: flex-start; }
    .mascot-bubble { background: #ffffff; color: #333; padding: 12px 18px; border-radius: 15px; border-bottom-left-radius: 0; box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 5px; margin-left: 25px; position: relative; max-width: 220px; animation: slideInLeft 1s; transition: all 0.3s; }
    .bubble-arrow { position: absolute; bottom: -8px; left: 10px; width: 0; height: 0; border-left: 10px solid transparent; border-top: 10px solid #ffffff; }
    
    .css-character { position: relative; width: 100px; height: 100px; cursor: pointer; margin-left: 10px; transition: transform 0.2s; }
    .character-body { width: 80px; height: 80px; background: linear-gradient(135deg, #43A047, #2E7D32); border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%; position: absolute; bottom: 10px; left: 10px; box-shadow: inset -5px -5px 10px rgba(0,0,0,0.2); z-index: 2; }
    
    .hand-left {
        width: 24px; height: 24px; background: #43A047; border-radius: 50%;
        position: absolute; bottom: 25px; left: -10px; z-index: 5;
        box-shadow: inset -3px -3px 5px rgba(0,0,0,0.1); transform-origin: right center;
        border: 2px solid #2E7D32;
    }
    .hand-left.waving { animation: wave-hand 0.5s infinite ease-in-out; }
    @keyframes wave-hand { 0% { transform: rotate(0deg); } 50% { transform: rotate(-45deg) translateY(-8px); } 100% { transform: rotate(0deg); } }

    .leaf-hair { width: 40px; height: 40px; background: #8BC34A; border-radius: 0 100% 0 100%; position: absolute; top: -15px; left: 35px; transform: rotate(-30deg); z-index: 1; box-shadow: inset 2px 2px 5px rgba(255,255,255,0.3); animation: leaf-wave 3s infinite ease-in-out; }
    .eye { width: 18px; height: 22px; background: white; border-radius: 50%; position: absolute; top: 25px; z-index: 3; overflow: hidden; }
    .eye.left { left: 18px; } .eye.right { right: 18px; }
    .pupil { width: 8px; height: 10px; background: #1c1c1c; border-radius: 50%; position: absolute; top: 6px; right: 4px; transition: transform 0.1s linear; }
    .cheeks { width: 12px; height: 8px; background: rgba(255, 150, 150, 0.6); border-radius: 50%; position: absolute; top: 45px; z-index: 3; }
    .cheeks.left { left: 10px; } .cheeks.right { right: 10px; }
    .mouth { width: 16px; height: 8px; border-bottom: 3px solid #1c1c1c; border-radius: 0 0 10px 10px; position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); z-index: 3; transition: all 0.2s; }
    .mouth.talking { height: 10px; width: 14px; background: #3e2723; border: none; border-radius: 50%; border-bottom: none; animation: talk-animation 0.2s infinite alternate; }
    .shadow-base { width: 60px; height: 10px; background: rgba(0,0,0,0.2); border-radius: 50%; position: absolute; bottom: 0; left: 20px; z-index: 0; animation: shadow-pulse 3s ease-in-out infinite; }

    /* Animations */
    @keyframes floating { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
    @keyframes leaf-wave { 0%, 100% { transform: rotate(-30deg); } 50% { transform: rotate(-10deg); } }
    @keyframes shadow-pulse { 0%, 100% { transform: scale(1); opacity: 0.2; } 50% { transform: scale(0.8); opacity: 0.1; } }
    @keyframes talk-animation { from { height: 8px; } to { height: 12px; } }

    /* Feature Cards & Icons */
    .icon-glow { width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; }
    .icon-glow-success { background: rgba(76, 175, 80, 0.1); color: #4CAF50; box-shadow: 0 0 15px rgba(76, 175, 80, 0.3); }
    .card-feature:hover .icon-glow-success { background: #4CAF50; color: white; box-shadow: 0 0 30px rgba(76, 175, 80, 0.6); transform: scale(1.1) rotate(-10deg); }
    .icon-glow-warning { background: rgba(255, 193, 7, 0.1); color: #FFC107; box-shadow: 0 0 15px rgba(255, 193, 7, 0.3); }
    .card-feature:hover .icon-glow-warning { background: #FFC107; color: white; box-shadow: 0 0 30px rgba(255, 193, 7, 0.6); transform: scale(1.1) rotate(10deg); }
    .icon-glow-primary { background: rgba(33, 150, 243, 0.1); color: #2196F3; box-shadow: 0 0 15px rgba(33, 150, 243, 0.3); }
    .card-feature:hover .icon-glow-primary { background: #2196F3; color: white; box-shadow: 0 0 30px rgba(33, 150, 243, 0.6); transform: scale(1.1); }

    /* Background Daun */
    .falling-leaves-container { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 0; pointer-events: none; overflow: hidden; }
    .leaf { position: absolute; top: -10%; animation: fall linear infinite; }
    @keyframes fall { 0% { transform: translateY(-10vh) translateX(0) rotate(0deg); opacity: 0; } 10% { opacity: 0.8; } 90% { opacity: 0.8; } 100% { transform: translateY(110vh) translateX(20px) rotate(360deg); opacity: 0; } }

    /* Utils */
    .hover-lift-sm:hover { transform: translateY(-5px); }
    .hover-scale:hover { transform: scale(1.05); }
    .animate-fade-up { animation: fadeInUp 0.8s forwards; }
    .animate-zoom-in { animation: zoomIn 0.8s forwards; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes zoomIn { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
    .animate-pulse { animation: pulse 2s infinite; }
    @keyframes pulse { 0% { transform: scale(1); opacity: 0.2; } 50% { transform: scale(1.2); opacity: 0.4; } 100% { transform: scale(1); opacity: 0.2; } }
</style>
@endsection