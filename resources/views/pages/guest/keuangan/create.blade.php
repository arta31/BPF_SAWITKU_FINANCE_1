@extends('layouts.guest.app')

@section('title', 'Catat Transaksi Baru')

@section('content')
<div class="dashboard-wrapper position-relative overflow-hidden" style="min-height: 100vh;">

    <!-- 1. ANIMASI DAUN JATUH (Speed Up!) -->
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
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <!-- Tombol Kembali -->
                <div class="mb-4 animate-fade-down">
                    <a href="{{ route('catatan-keuangan.index') }}" class="text-decoration-none text-secondary fw-bold d-inline-flex align-items-center hover-scale-small">
                        <div class="icon-box-sm bg-white shadow-sm rounded-circle me-2 text-dark">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        Kembali ke Riwayat
                    </a>
                </div>

                <!-- KARTU FORM UTAMA -->
                <div class="card border-0 shadow-lg rounded-5 overflow-hidden glass-card animate-zoom-in position-relative">
                    
                    <!-- Garis Hiasan Atas -->
                    <div class="position-absolute top-0 start-0 end-0 bg-gradient-green" style="height: 8px;"></div>

                    <div class="card-body p-4 p-md-5">
                        
                        <!-- Header Form -->
                        <div class="text-center mb-5">
                            <div class="d-inline-flex align-items-center justify-content-center bg-gradient-green text-white rounded-circle mb-3 shadow-lg hover-bounce" style="width: 80px; height: 80px; font-size: 2.5rem;">
                                <i class="fas fa-plus"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-1">Catat Transaksi</h3>
                            <p class="text-secondary small">Masukkan detail panen atau pengeluaran kebun.</p>
                        </div>

                        <!-- Form Input -->
                        <form action="{{ route('catatan-keuangan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- 1. INPUT JENIS TRANSAKSI (TOMBOL BESAR) -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary small text-uppercase ls-1">Jenis Transaksi</label>
                                <div class="row g-3">
                                    <!-- Pemasukan -->
                                    <div class="col-6">
                                        <input type="radio" class="btn-check" name="jenis" id="pemasukan" value="pemasukan" {{ old('jenis') == 'pemasukan' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-success w-100 py-3 rounded-4 fw-bold d-flex flex-column align-items-center gap-2 h-100 card-select transition-all" for="pemasukan">
                                            <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle mb-1">
                                                <i class="fas fa-leaf"></i>
                                            </div>
                                            <span>Pemasukan</span>
                                        </label>
                                    </div>
                                    <!-- Pengeluaran -->
                                    <div class="col-6">
                                        <input type="radio" class="btn-check" name="jenis" id="pengeluaran" value="pengeluaran" {{ old('jenis') == 'pengeluaran' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-warning w-100 py-3 rounded-4 fw-bold d-flex flex-column align-items-center gap-2 h-100 card-select transition-all" for="pengeluaran">
                                            <div class="icon-box bg-warning bg-opacity-10 text-warning rounded-circle mb-1">
                                                <i class="fas fa-tools"></i>
                                            </div>
                                            <span>Pengeluaran</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. INPUT TANGGAL -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary small text-uppercase ls-1">Tanggal</label>
                                <div class="input-group shadow-sm hover-lift-sm transition-all">
                                    <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3 text-success">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                    <input type="date" name="tanggal" class="form-control border-start-0 rounded-end-pill py-3 ps-2" 
                                           value="{{ old('tanggal', date('Y-m-d')) }}" required style="cursor: pointer;">
                                </div>
                            </div>

                            <!-- 3. INPUT DESKRIPSI -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary small text-uppercase ls-1">Keterangan</label>
                                <div class="input-group shadow-sm hover-lift-sm transition-all">
                                    <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3 text-success">
                                        <i class="fas fa-pen"></i>
                                    </span>
                                    <input type="text" name="deskripsi" class="form-control border-start-0 rounded-end-pill py-3 ps-2" 
                                           placeholder="Contoh: Jual TBS 2 Ton / Beli Pupuk" value="{{ old('deskripsi') }}" required>
                                </div>
                            </div>

                            <!-- 4. INPUT NOMINAL -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary small text-uppercase ls-1">Nominal (Rupiah)</label>
                                <div class="input-group shadow-sm hover-lift-sm transition-all">
                                    <span class="input-group-text bg-gradient-green text-white border-0 rounded-start-pill ps-3 fw-bold">
                                        Rp
                                    </span>
                                    <input type="number" name="nominal" class="form-control border-0 rounded-end-pill py-3 ps-2 fw-bold text-dark bg-white" 
                                           placeholder="0" value="{{ old('nominal') }}" required style="font-size: 1.2rem;">
                                </div>
                            </div>

                            <!-- 5. INPUT BUKTI (UPLOAD KEREN) -->
                            <div class="mb-5">
                                <label class="form-label fw-bold text-secondary small text-uppercase ls-1">Bukti Foto (Opsional)</label>
                                <div class="upload-area border-2 border-dashed rounded-4 p-4 text-center position-relative transition-all">
                                    <div class="upload-icon mb-2 text-secondary">
                                        <i class="fas fa-cloud-upload-alt fa-3x"></i>
                                    </div>
                                    <p class="text-muted small mb-0 fw-bold">Klik box ini untuk upload foto nota/struk</p>
                                    <p class="text-secondary x-small mt-1 opacity-50">(Max 2MB: jpg, png, pdf)</p>
                                    
                                    <input type="file" name="bukti" class="form-control position-absolute top-0 start-0 h-100 w-100 opacity-0" style="cursor: pointer;" onchange="previewFile(this)">
                                    
                                    <!-- Tempat Nama File Muncul -->
                                    <div id="file-preview" class="mt-2 d-none">
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                            <i class="fas fa-check me-1"></i> <span id="file-name"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- TOMBOL SIMPAN -->
                            <button type="submit" class="btn btn-gradient-success w-100 py-3 rounded-pill fw-bold shadow-lg hover-scale position-relative overflow-hidden">
                                <span class="position-relative z-2"><i class="fas fa-save me-2"></i> SIMPAN CATATAN</span>
                                <div class="shine-effect"></div>
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script Preview Nama File --}}
<script>
    function previewFile(input) {
        const previewDiv = document.getElementById('file-preview');
        const nameSpan = document.getElementById('file-name');
        if (input.files && input.files[0]) {
            nameSpan.innerText = input.files[0].name;
            previewDiv.classList.remove('d-none');
        }
    }
</script>

<style>
    /* --- UTILS --- */
    .ls-1 { letter-spacing: 1px; }
    .x-small { font-size: 0.75rem; }
    .icon-box { width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; transition: 0.3s; }
    .icon-box-sm { width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; }

    /* --- GLASS CARD --- */
    .glass-card {
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.6);
    }
    [data-theme="dark"] .glass-card {
        background: rgba(30, 30, 30, 0.92);
        border-color: rgba(255, 255, 255, 0.1);
    }

    /* --- CARD SELECT (RADIO BUTTON) --- */
    .btn-check:checked + .btn-outline-success {
        background-color: #E8F5E9; color: #2E7D32; border-color: #2E7D32;
        box-shadow: 0 4px 12px rgba(46, 125, 50, 0.2); transform: translateY(-2px);
    }
    .btn-check:checked + .btn-outline-warning {
        background-color: #FFF3E0; color: #EF6C00; border-color: #EF6C00;
        box-shadow: 0 4px 12px rgba(239, 108, 0, 0.2); transform: translateY(-2px);
    }
    .card-select:hover { transform: translateY(-2px); }

    /* --- UPLOAD AREA --- */
    .upload-area {
        background-color: #f8f9fa; border-color: #cbd5e1; border-style: dashed;
    }
    .upload-area:hover {
        background-color: #ffffff; border-color: #2E7D32; box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    [data-theme="dark"] .upload-area { background-color: #2c2c2c; border-color: #444; }
    [data-theme="dark"] .upload-area:hover { background-color: #333; border-color: #4CAF50; }

    /* --- BUTTON GRADIENT --- */
    .bg-gradient-green { background: linear-gradient(135deg, #2E7D32 0%, #66BB6A 100%); }
    .btn-gradient-success {
        background: linear-gradient(90deg, #2E7D32 0%, #43A047 100%);
        color: white; border: none; transition: 0.3s;
    }
    .btn-gradient-success:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(46,125,50,0.3); color: white; }
    
    .shine-effect {
        position: absolute; top: 0; left: -100%; width: 50%; height: 100%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
        transform: skewX(-25deg); animation: shine 3s infinite;
    }
    @keyframes shine { 100% { left: 200%; } }

    /* --- INPUT STYLES --- */
    .form-control:focus { box-shadow: none; border-color: #2E7D32; }
    .hover-lift-sm:hover { transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
    .hover-bounce:hover { animation: bounce 1s infinite; }
    @keyframes bounce { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-5px); } }

    /* --- ANIMASI DAUN CEPAT (SPEED UP) --- */
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
            /* Durasi lebih cepat: 5s - 15s */
            animation-duration: {{ rand(5, 15) }}s; 
            animation-delay: {{ rand(0, 10) }}s;
            font-size: {{ rand(20, 40) }}px;
        }
    @endfor
    @keyframes fall {
        0% { transform: translateY(-10vh) rotate(0deg) translateX(0); opacity: 0.6; }
        100% { transform: translateY(110vh) rotate(720deg) translateX(50px); opacity: 0.6; }
    }

    /* --- ANIMASI MASUK --- */
    .animate-zoom-in { animation: zoomIn 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; opacity: 0; }
    .animate-fade-down { animation: fadeInDown 0.6s forwards; opacity: 0; }
    @keyframes zoomIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection