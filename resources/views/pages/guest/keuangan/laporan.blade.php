@extends('layouts.guest.app')

@section('title', 'Laporan Keuangan')

@section('content')
<div class="dashboard-wrapper position-relative overflow-hidden" style="min-height: 100vh;">

    <!-- 1. ANIMASI DAUN JATUH (LEBIH CEPAT & HIDUP) -->
    <div class="falling-leaves-container">
        @for ($i = 0; $i < 30; $i++)
            @php
                $colors = ['#4CAF50', '#8BC34A', '#FFC107', '#FF9800', '#AED581']; 
                $randomColor = $colors[array_rand($colors)];
                $icons = ['fa-leaf', 'fa-seedling', 'fa-tree', 'fa-cloud-sun'];
            @endphp
            <div class="leaf leaf-{{ $i }}" style="color: {{ $randomColor }}; text-shadow: 0 0 5px {{ $randomColor }};">
                <i class="fas {{ $icons[array_rand($icons)] }}"></i>
            </div>
        @endfor
    </div>

    <div class="container position-relative z-2 py-4">
        
        <!-- HEADER HALAMAN -->
        <div class="text-center mb-5 animate-fade-down">
            <div class="d-inline-flex align-items-center justify-content-center bg-gradient-green text-white rounded-circle mb-3 shadow-lg hover-bounce" style="width: 90px; height: 90px; font-size: 3rem;">
                <i class="fas fa-chart-pie"></i>
            </div>
            <h2 class="fw-bold text-dark mb-1">Laporan Bulanan</h2>
            <p class="text-secondary fs-5">Rekapitulasi pemasukan vs pengeluaran dalam satu garis.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-9">

                @forelse($laporanPerBulan as $periode => $data)
                    @php
                        $pemasukan = $data->where('jenis', 'pemasukan')->sum('nominal');
                        $pengeluaran = $data->where('jenis', 'pengeluaran')->sum('nominal');
                        $labaBersih = $pemasukan - $pengeluaran;
                        $totalVolume = $pemasukan + $pengeluaran;
                        
                        // Hitung Persentase untuk Progress Bar
                        if ($totalVolume > 0) {
                            $persenMasuk = ($pemasukan / $totalVolume) * 100;
                            $persenKeluar = ($pengeluaran / $totalVolume) * 100;
                        } else {
                            $persenMasuk = 0;
                            $persenKeluar = 0;
                        }
                    @endphp

                    <!-- KARTU LAPORAN (Menyatu & Persentase Bar) -->
                    <div class="card border-0 shadow-lg rounded-5 mb-5 overflow-hidden glass-card animate-fade-up hover-lift">
                        
                        <!-- Header: Bulan & Jumlah Transaksi -->
                        <div class="card-header bg-white bg-opacity-50 border-0 pt-4 px-4 px-md-5 d-flex justify-content-between align-items-center">
                            <h4 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                                <span class="icon-box-sm bg-white text-success rounded-circle shadow-sm animate-pulse-slow">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                                {{ $periode }}
                            </h4>
                            <span class="badge bg-white text-secondary rounded-pill px-3 border shadow-sm">
                                {{ $data->count() }} Transaksi
                            </span>
                        </div>

                        <div class="card-body p-4 p-md-5">
                            
                            <!-- 1. INFO UTAMA: LABA/RUGI -->
                            <div class="p-4 rounded-5 text-white position-relative overflow-hidden shadow-md mb-4 d-flex flex-column justify-content-center card-hover-3d"
                                 style="background: {{ $labaBersih >= 0 ? 'linear-gradient(135deg, #2E7D32, #66BB6A)' : 'linear-gradient(135deg, #C62828, #EF5350)' }}; min-height: 120px;">
                                
                                <div class="position-relative z-2">
                                    <small class="text-uppercase fw-bold text-white text-opacity-75 ls-1 mb-1">
                                        {{ $labaBersih >= 0 ? 'Keuntungan Bersih' : 'Kerugian' }}
                                    </small>
                                    <h2 class="fw-bold mb-0 display-5">
                                        Rp {{ number_format($labaBersih, 0, ',', '.') }}
                                    </h2>
                                </div>
                                <!-- Ikon Background -->
                                <div class="icon-bg position-absolute end-0 top-50 translate-middle-y opacity-25 me-4 icon-bg-animate">
                                    <i class="fas {{ $labaBersih >= 0 ? 'fa-coins' : 'fa-chart-line-down' }}" style="font-size: 5rem;"></i>
                                </div>
                                <div class="shine-effect"></div>
                            </div>

                            <!-- 2. RINCIAN KIRI-KANAN -->
                            <div class="row g-4 mb-4">
                                <!-- Pemasukan -->
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between p-3 rounded-4 bg-light border border-light-subtle transition-all hover-bg-success-light">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="icon-box-sm bg-success bg-opacity-10 text-success rounded-circle">
                                                <i class="fas fa-arrow-up"></i>
                                            </div>
                                            <div>
                                                <small class="text-secondary fw-bold d-block text-uppercase" style="font-size: 0.65rem;">Pemasukan</small>
                                                <span class="fw-bold text-dark">Rp {{ number_format($pemasukan, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                        <span class="fw-bold text-success">{{ number_format($persenMasuk, 0) }}%</span>
                                    </div>
                                </div>

                                <!-- Pengeluaran -->
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between p-3 rounded-4 bg-light border border-light-subtle transition-all hover-bg-warning-light">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="icon-box-sm bg-warning bg-opacity-10 text-warning rounded-circle">
                                                <i class="fas fa-arrow-down"></i>
                                            </div>
                                            <div>
                                                <small class="text-secondary fw-bold d-block text-uppercase" style="font-size: 0.65rem;">Pengeluaran</small>
                                                <span class="fw-bold text-dark">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                        <span class="fw-bold text-warning">{{ number_format($persenKeluar, 0) }}%</span>
                                    </div>
                                </div>
                            </div>

                            <!-- 3. PROGRESS BAR YANG MENYATU (FITUR UTAMA) -->
                            @if($totalVolume > 0)
                            <div class="mt-2">
                                <div class="d-flex justify-content-between small text-secondary mb-2 fw-bold text-uppercase ls-1">
                                    <span><i class="fas fa-chart-bar me-2 text-success"></i>Rasio Arus Kas</span>
                                </div>
                                
                                {{-- Bar Persentase Menyatu --}}
                                <div class="progress rounded-pill shadow-inner overflow-hidden" style="height: 25px; background-color: #e9ecef; border: 1px solid rgba(0,0,0,0.05);">
                                    <!-- Bagian Hijau (Pemasukan) -->
                                    <div class="progress-bar bg-gradient-green progress-animated d-flex align-items-center justify-content-center" 
                                         role="progressbar" 
                                         style="width: 0%; --target-width: {{ $persenMasuk }}%" 
                                         aria-valuenow="{{ $persenMasuk }}" aria-valuemin="0" aria-valuemax="100">
                                         @if($persenMasuk > 10) 
                                            <span class="small fw-bold text-white text-shadow">{{ number_format($persenMasuk, 0) }}%</span> 
                                         @endif
                                    </div>
                                    <!-- Bagian Oranye (Pengeluaran) -->
                                    <div class="progress-bar bg-gradient-orange progress-animated d-flex align-items-center justify-content-center" 
                                         role="progressbar" 
                                         style="width: 0%; --target-width: {{ $persenKeluar }}%"
                                         aria-valuenow="{{ $persenKeluar }}" aria-valuemin="0" aria-valuemax="100">
                                         @if($persenKeluar > 10) 
                                            <span class="small fw-bold text-white text-shadow">{{ number_format($persenKeluar, 0) }}%</span> 
                                         @endif
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between mt-2 small">
                                    <span class="text-success fw-bold"><i class="fas fa-circle me-1 small"></i> Pemasukan (Masuk)</span>
                                    <span class="text-warning fw-bold">Pengeluaran (Keluar) <i class="fas fa-circle me-1 small"></i></span>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>

                @empty
                    <div class="card border-0 shadow-lg rounded-5 glass-card text-center py-5 animate-fade-up">
                        <div class="card-body">
                            <div class="mb-3 text-secondary opacity-25">
                                <i class="fas fa-folder-open fa-4x"></i>
                            </div>
                            <h5 class="text-dark fw-bold">Belum Ada Laporan</h5>
                            <a href="{{ route('catatan-keuangan.create') }}" class="btn btn-gradient-success rounded-pill px-4 py-2 mt-3 fw-bold shadow-sm btn-interactive">
                                <span class="position-relative z-2"><i class="fas fa-plus me-2"></i> Catat Sekarang</span>
                                <div class="shine-effect"></div>
                            </a>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</div>

<style>
    /* --- ANIMASI BAR (PENTING) --- */
    .progress-animated { 
        animation: fillProgress 1.5s cubic-bezier(0.4, 0, 0.2, 1) forwards; 
    }
    @keyframes fillProgress { 
        from { width: 0%; } 
        to { width: var(--target-width); } 
    }
    
    .text-shadow { text-shadow: 0 1px 2px rgba(0,0,0,0.3); }

    /* --- UTILS --- */
    .falling-leaves-container {
        position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
        overflow: hidden; z-index: 0; pointer-events: none;
    }
    .leaf {
        position: absolute; top: -10%; opacity: 0.4;
        animation: fall linear infinite;
    }
    @for ($i = 0; $i < 30; $i++)
        .leaf-{{ $i }} {
            left: {{ rand(0, 100) }}%;
            /* Durasi LEBIH CEPAT: 5s - 15s */
            animation-duration: {{ rand(5, 15) }}s; 
            animation-delay: {{ rand(0, 10) }}s;
            font-size: {{ rand(20, 40) }}px;
        }
    @endfor
    @keyframes fall {
        0% { transform: translateY(-10vh) rotate(0deg) translateX(0); opacity: 0.6; }
        100% { transform: translateY(110vh) rotate(720deg) translateX(50px); opacity: 0.6; }
    }

    /* Glass Card */
    .glass-card {
        background: rgba(255, 255, 255, 0.85) !important;
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }
    [data-theme="dark"] .glass-card {
        background: rgba(30, 30, 30, 0.9);
        border-color: rgba(255, 255, 255, 0.1);
    }
    [data-theme="dark"] .bg-light {
        background-color: rgba(255,255,255,0.05) !important;
        border-color: rgba(255,255,255,0.1) !important;
    }

    .bg-gradient-green { background: linear-gradient(135deg, #2E7D32 0%, #66BB6A 100%); }
    .bg-gradient-orange { background: linear-gradient(135deg, #FF9800 0%, #FFB74D 100%); }
    
    .btn-gradient-success {
        background: linear-gradient(90deg, #2E7D32 0%, #43A047 100%);
        color: white; border: none; transition: 0.3s;
        position: relative; overflow: hidden;
    }
    .btn-gradient-success:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(46,125,50,0.3); color: white; }

    .icon-box-sm { width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }
    
    .hover-bg-success-light:hover { background-color: rgba(46, 125, 50, 0.2) !important; }
    .hover-bg-warning-light:hover { background-color: rgba(255, 152, 0, 0.2) !important; }

    /* SHINE & INTERACTION */
    .shine-effect {
        position: absolute; top: 0; left: -100%; width: 50%; height: 100%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
        transform: skewX(-25deg);
        animation: shine 3s infinite;
    }
    @keyframes shine { 100% { left: 200%; } }

    .card-hover-3d:hover { transform: translateY(-5px) scale(1.02); box-shadow: 0 20px 40px rgba(0,0,0,0.2); }
    .icon-bg-animate { transition: transform 0.5s; }
    .card-hover-3d:hover .icon-bg-animate { transform: rotate(0deg) scale(1.2); opacity: 0.3; }

    .animate-fade-up { animation: fadeInUp 0.8s forwards; }
    .animate-fade-down { animation: fadeInDown 0.8s forwards; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-30px); } to { opacity: 1; transform: translateY(0); } }
    
    .animate-pulse-slow { animation: pulse 2s infinite; }
    @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.1); } 100% { transform: scale(1); } }

    /* Tombol Interaktif */
    .btn-interactive:hover { transform: scale(1.05); box-shadow: 0 0 20px rgba(76, 175, 80, 0.6); }
    .btn-interactive:active { transform: scale(0.95); }
</style>
@endsection