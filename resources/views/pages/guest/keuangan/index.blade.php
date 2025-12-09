@extends('layouts.guest.app')

@section('title', 'Riwayat Transaksi Kebun')

@section('content')
{{-- 1. BACKGROUND DAUN JATUH --}}
<div class="falling-leaves-container">
    @for ($i = 0; $i < 25; $i++)
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

<div class="dashboard-wrapper position-relative z-2" style="min-height: 100vh;">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 animate-fade-down glass-card p-4 rounded-5">
        <div class="d-flex align-items-center gap-4 mb-3 mb-md-0">
            <div class="icon-box-lg bg-gradient-green text-white rounded-circle shadow-lg animate-pulse" style="width: 80px; height: 80px;">
                <i class="fas fa-history fa-2x"></i>
            </div>
            <div>
                <h2 class="fw-bold text-dark mb-1">Riwayat Transaksi</h2>
                <p class="text-secondary fs-6 fw-normal mb-0">Catatan lengkap aktivitas kebun Anda.</p>
            </div>
        </div>
        <a href="{{ route('catatan-keuangan.create') }}" class="btn btn-gradient-success rounded-pill px-4 py-3 shadow-lg fw-bold hover-bounce">
            <i class="fas fa-plus-circle me-2 fa-lg"></i> Catat Transaksi Baru
        </a>
    </div>

    {{-- ALERT SUKSES DIHAPUS, DIGANTI SWEETALERT POPUP OTOMATIS --}}

    <div class="row g-4">
        @forelse ($catatans as $index => $catatan)
            <div class="col-lg-4 col-md-6 animate-fade-up" style="animation-delay: {{ $index * 0.1 }}s;">
                <div class="card border-0 shadow-lg rounded-5 h-100 position-relative overflow-hidden glass-card hover-lift transition-all">

                    <i class="fas {{ $catatan->jenis == 'pemasukan' ? 'fa-leaf' : 'fa-tools' }} position-absolute bottom-0 end-0 opacity-10"
                       style="font-size: 8rem; margin-right: -20px; margin-bottom: -20px; transform: rotate(-15deg); color: {{ $catatan->jenis == 'pemasukan' ? '#2E7D32' : '#EF6C00' }};">
                    </i>

                    <div class="position-absolute top-0 start-0 end-0"
                         style="height: 6px; background: {{ $catatan->jenis == 'pemasukan' ? 'linear-gradient(90deg, #2E7D32, #66BB6A)' : 'linear-gradient(90deg, #EF6C00, #FF9800)' }};">
                    </div>

                    <div class="card-body p-4 position-relative z-2">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <span class="badge rounded-pill px-3 py-2 mb-2 shadow-sm
                                    {{ $catatan->jenis == 'pemasukan' ? 'bg-success bg-opacity-10 text-success' : 'bg-warning bg-opacity-10 text-warning' }}">
                                    <i class="fas {{ $catatan->jenis == 'pemasukan' ? 'fa-arrow-up' : 'fa-arrow-down' }} me-1"></i>
                                    {{ strtoupper($catatan->jenis) }}
                                </span>
                                <small class="text-uppercase fw-bold text-secondary d-block ls-1" style="font-size: 0.7rem;">
                                    {{ \Carbon\Carbon::parse($catatan->tanggal)->isoFormat('dddd, D MMMM Y') }}
                                </small>
                            </div>

                            <div class="icon-box rounded-circle shadow-lg text-white animate-pulse-sm"
                                 style="background: {{ $catatan->jenis == 'pemasukan' ? 'linear-gradient(135deg, #2E7D32, #66BB6A)' : 'linear-gradient(135deg, #EF6C00, #FF9800)' }};">
                                <i class="fas {{ $catatan->jenis == 'pemasukan' ? 'fa-leaf' : 'fa-tools' }} fa-lg"></i>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="fw-bold text-dark mb-2 text-truncate" title="{{ $catatan->deskripsi }}">
                                {{ $catatan->deskripsi }}
                            </h5>
                            <h3 class="fw-bold mb-0 display-6" style="color: {{ $catatan->jenis == 'pemasukan' ? '#2E7D32' : '#D32F2F' }};">
                                {{ $catatan->jenis == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($catatan->nominal, 0, ',', '.') }}
                            </h3>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-3 border-top border-light-subtle">
                            @if ($catatan->bukti)
                                <a href="{{ asset('storage/' . $catatan->bukti) }}" target="_blank"
                                   class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-bold hover-filled-primary transition-all">
                                    <i class="fas fa-image me-1"></i> Lihat Bukti
                                </a>
                            @else
                                <span class="text-muted small fst-italic ms-2 opacity-75"><i class="fas fa-ban me-1"></i> Tanpa bukti</span>
                            @endif

                            <div class="btn-group shadow-sm rounded-pill overflow-hidden">
                                <a href="{{ route('catatan-keuangan.edit', $catatan->id) }}"
                                   class="btn btn-light text-warning px-3 hover-warning transition-all" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('catatan-keuangan.destroy', $catatan->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light text-danger px-3 hover-danger transition-all delete-confirm" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 animate-fade-up">
                <div class="card border-0 shadow-lg rounded-5 text-center py-5 glass-card position-relative overflow-hidden">
                    <div class="card-body position-relative z-2">
                        <div class="mb-4 opacity-50 animate-bounce-slow">
                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" alt="Empty" width="150">
                        </div>
                        <h3 class="fw-bold text-dark">Belum Ada Catatan</h3>
                        <p class="text-secondary mb-4 fs-5">Mulai catat hasil panen atau pengeluaran kebun Anda sekarang.</p>
                        <a href="{{ route('catatan-keuangan.create') }}" class="btn btn-gradient-success rounded-pill px-5 py-3 fw-bold shadow-lg hover-scale">
                            <i class="fas fa-plus-circle me-2 fa-lg"></i> Buat Catatan Pertama
                        </a>
                    </div>
                    <i class="fas fa-seedling position-absolute bottom-0 start-0 opacity-5" style="font-size: 15rem; margin-left: -50px; margin-bottom: -50px; transform: rotate(30deg); color: var(--accent-green);"></i>
                </div>
            </div>
        @endforelse
    </div>
    
    {{-- TOMBOL PAGINATION (SUDAH DIAKTIFKAN) --}}
    <div class="mt-5 d-flex justify-content-center animate-fade-up">
        {{ $catatans->links() }}
    </div>

</div>

<style>
    /* CSS DAUN, GLASS, & ANIMASI (TETAP SAMA SEPERTI YANG LAMA) */
    .falling-leaves-container {
        position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
        overflow: hidden; z-index: 0; pointer-events: none;
    }
    .leaf {
        position: absolute; top: -10%; opacity: 0.4;
        animation: fall linear infinite;
    }
    @for ($i = 0; $i < 25; $i++)
        .leaf-{{ $i }} {
            left: {{ rand(0, 100) }}%;
            animation-duration: {{ rand(10, 25) }}s;
            animation-delay: {{ rand(0, 20) }}s;
            font-size: {{ rand(20, 40) }}px;
        }
    @endfor
    @keyframes fall {
        0% { transform: translateY(-10vh) rotate(0deg); opacity: 0; }
        10% { opacity: 0.6; }
        90% { opacity: 0.6; }
        100% { transform: translateY(110vh) rotate(720deg); opacity: 0; }
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.85) !important;
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }
    [data-theme="dark"] .glass-card {
        background: rgba(30, 30, 30, 0.85) !important;
        border-color: rgba(255, 255, 255, 0.1);
    }

    .bg-gradient-green { background: linear-gradient(135deg, #2E7D32 0%, #66BB6A 100%); }
    .btn-gradient-success {
        background: linear-gradient(90deg, #2E7D32 0%, #43A047 100%);
        color: white; border: none; transition: all 0.3s ease;
    }
    .btn-gradient-success:hover {
        transform: translateY(-3px); box-shadow: 0 10px 20px rgba(46, 125, 50, 0.3);
        background: linear-gradient(90deg, #1B5E20 0%, #2E7D32 100%); color: white;
    }

    .icon-box { width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; }
    .icon-box-lg { width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; }
    .ls-1 { letter-spacing: 1px; }
    .transition-all { transition: all 0.3s ease; }

    .hover-lift:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }
    .hover-scale:hover { transform: scale(1.03); }
    .hover-bounce:hover { animation: bounce 1s infinite; }
    .hover-warning:hover { background-color: #FFF3E0 !important; color: #F57C00 !important; }
    .hover-danger:hover { background-color: #FFEBEE !important; color: #D32F2F !important; }
    .hover-filled-primary:hover { background-color: var(--bs-primary); color: white; }

    .animate-pulse { animation: pulse-green 2s infinite; }
    .animate-pulse-sm { animation: pulse-sm 2s infinite; }
    @keyframes pulse-green {
        0% { box-shadow: 0 0 0 0 rgba(46, 125, 50, 0.7); }
        70% { box-shadow: 0 0 0 15px rgba(46, 125, 50, 0); }
        100% { box-shadow: 0 0 0 0 rgba(46, 125, 50, 0); }
    }
    @keyframes pulse-sm {
        0%, 100% { transform: scale(1); } 50% { transform: scale(1.1); }
    }
    @keyframes bounce {
        0%, 100% { transform: translateY(0); } 50% { transform: translateY(-5px); }
    }
     @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); }
    }
    .animate-bounce-slow { animation: bounce-slow 3s ease-in-out infinite; }

    .animate-fade-up { animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; opacity: 0; }
    .animate-fade-down { animation: fadeInDown 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; opacity: 0; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-40px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection