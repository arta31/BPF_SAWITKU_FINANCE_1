@extends('layouts.guest.app')

@section('title', 'Edit Transaksi')

@section('content')
<div class="dashboard-container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <!-- Tombol Kembali -->
            <div class="mb-4">
                <a href="{{ route('catatan-keuangan.index') }}" class="text-decoration-none text-secondary fw-bold d-inline-flex align-items-center hover-text-warning">
                    <i class="fas fa-arrow-left me-2"></i> Batal & Kembali
                </a>
            </div>

            <!-- Kartu Form Utama -->
            <div class="card border-0 shadow-lg rounded-5 overflow-hidden position-relative">
                
                <!-- Garis Hiasan Atas (Warna Oranye Sawit Matang) -->
                <div class="position-absolute top-0 start-0 end-0 bg-warning" style="height: 8px;"></div>

                <div class="card-body p-5">
                    
                    <!-- Header Form -->
                    <div class="text-center mb-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning rounded-circle mb-3 shadow-sm" style="width: 80px; height: 80px;">
                            <i class="fas fa-edit fa-2x"></i>
                        </div>
                        <h3 class="fw-bold text-dark mb-1">Edit Transaksi</h3>
                        <p class="text-secondary small">Perbaiki data panen atau pengeluaran Anda.</p>
                    </div>

                    <!-- Form Input -->
                    <form action="{{ route('catatan-keuangan.update', $catatan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Input Tanggal -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Tanggal</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3 text-warning">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                                <input type="date" name="tanggal" class="form-control bg-light border-start-0 rounded-end-pill py-3 ps-2" 
                                       value="{{ old('tanggal', $catatan->tanggal) }}" required style="cursor: pointer;">
                            </div>
                        </div>

                        <!-- Input Jenis Transaksi -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Jenis Transaksi</label>
                            <div class="row g-3">
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="jenis" id="pemasukan" value="pemasukan" {{ old('jenis', $catatan->jenis) == 'pemasukan' ? 'checked' : '' }} required>
                                    <label class="btn btn-outline-success w-100 py-3 rounded-4 fw-bold d-flex flex-column align-items-center gap-2 h-100 transition-all" for="pemasukan">
                                        <i class="fas fa-leaf fs-4"></i>
                                        <span>Pemasukan</span>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="jenis" id="pengeluaran" value="pengeluaran" {{ old('jenis', $catatan->jenis) == 'pengeluaran' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-danger w-100 py-3 rounded-4 fw-bold d-flex flex-column align-items-center gap-2 h-100 transition-all" for="pengeluaran">
                                        <i class="fas fa-tools fs-4"></i>
                                        <span>Pengeluaran</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Input Deskripsi -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Keterangan</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3 text-warning">
                                    <i class="fas fa-pen"></i>
                                </span>
                                <input type="text" name="deskripsi" class="form-control bg-light border-start-0 rounded-end-pill py-3 ps-2" 
                                       placeholder="Contoh: Jual TBS 2 Ton" value="{{ old('deskripsi', $catatan->deskripsi) }}" required>
                            </div>
                        </div>

                        <!-- Input Nominal -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Nominal (Rupiah)</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-warning text-dark border-0 rounded-start-pill ps-3 fw-bold">
                                    Rp
                                </span>
                                <input type="number" name="nominal" class="form-control bg-light border-0 rounded-end-pill py-3 ps-2 fw-bold text-dark" 
                                       placeholder="0" value="{{ old('nominal', $catatan->nominal) }}" required>
                            </div>
                        </div>

                        <!-- Input Bukti -->
                        <div class="mb-5">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Bukti Foto (Opsional)</label>
                            <div class="border-2 border-dashed rounded-4 p-4 text-center bg-light position-relative hover-bg-white transition-all" style="border-style: dashed; border-color: #cbd5e1;">
                                
                                <i class="fas fa-cloud-upload-alt fs-3 text-secondary mb-2"></i>
                                <p class="text-muted small mb-2">Klik untuk ganti foto nota/struk</p>
                                <input type="file" name="bukti" class="form-control position-absolute top-0 start-0 h-100 w-100 opacity-0" style="cursor: pointer;">
                                <small class="d-block text-success mt-2" id="file-name-display"></small>

                                <!-- Tampilkan Bukti Lama -->
                                @if($catatan->bukti)
                                    <div class="mt-3 p-2 bg-white rounded-3 shadow-sm border d-inline-block position-relative z-2">
                                        <small class="d-block text-secondary mb-1" style="font-size: 0.7rem;">File Saat Ini:</small>
                                        <a href="{{ asset('storage/' . $catatan->bukti) }}" target="_blank" class="text-decoration-none fw-bold text-primary d-flex align-items-center justify-content-center gap-2">
                                            <i class="fas fa-image"></i> Lihat Bukti Lama
                                        </a>
                                    </div>
                                @endif

                            </div>
                        </div>

                        <!-- Tombol Simpan -->
                        <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill fw-bold shadow-sm hover-scale text-dark">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script Kecil untuk Menampilkan Nama File yang Diupload --}}
<script>
    document.querySelector('input[type="file"]').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        document.getElementById('file-name-display').innerText = "File terpilih: " + fileName;
    });
</script>

<style>
    .hover-text-warning:hover { color: #ffc107 !important; }
    .hover-scale:hover { transform: scale(1.02); transition: transform 0.2s; }
    .form-control:focus { box-shadow: none; border-color: #ffc107; }
    
    /* Style Radio Button Kustom */
    .btn-check:checked + .btn-outline-success { background-color: #E8F5E9; color: #2E7D32; border-color: #2E7D32; }
    .btn-check:checked + .btn-outline-danger { background-color: #FFEBEE; color: #D32F2F; border-color: #D32F2F; }
    
    .hover-bg-white:hover { background-color: #ffffff !important; border-color: #ffc107 !important; }
    .transition-all { transition: all 0.3s ease; }
</style>
@endsection