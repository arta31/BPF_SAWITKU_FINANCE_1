@extends('layouts.guest.app')

@section('title', 'Pengaturan Aplikasi')

@section('content')
<div class="admin-wrapper" style="min-height: 100vh; background-color: #0f172a;">
    <div class="container px-4 py-5">
        
        <div class="d-flex justify-content-between align-items-center mb-5 animate-fade-down">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="text-muted text-decoration-none small mb-2 d-block hover-text-gold">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
                </a>
                <h2 class="text-white fw-bold mb-0">Pengaturan Aplikasi</h2>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success bg-success bg-opacity-25 text-success border-0 rounded-4 mb-4">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card bg-dark-glass border-0 shadow-lg rounded-4 overflow-hidden animate-fade-up">
                    <div class="card-body p-5">
                        
                        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="text-center mb-5">
                                <div class="logo-preview-box mx-auto mb-3 d-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm" style="width: 120px; height: 120px; overflow: hidden;">
                                    @if($setting->logo)
                                        <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" class="img-fluid" style="max-height: 80px;">
                                    @else
                                        <i class="fas fa-seedling fa-3x text-success"></i>
                                    @endif
                                </div>
                                <p class="text-muted small">Logo Saat Ini</p>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-gold small fw-bold ls-1">NAMA APLIKASI</label>
                                <input type="text" name="app_name" class="form-control form-dark" value="{{ $setting->app_name }}" required>
                            </div>

                            <div class="mb-5">
                                <label class="form-label text-gold small fw-bold ls-1">GANTI LOGO (PNG/JPG)</label>
                                <input type="file" name="logo" class="form-control form-dark">
                                <small class="text-muted">*Kosongkan jika tidak ingin mengubah logo.</small>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-gold-gradient py-3 fw-bold shadow-gold">
                                    <i class="fas fa-save me-2"></i> SIMPAN PENGATURAN
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
    .bg-dark-glass { background-color: #1e293b; border: 1px solid #334155; }
    .form-dark { background-color: #0f172a; border: 1px solid #334155; color: #fff; padding: 12px; border-radius: 10px; }
    .form-dark:focus { background-color: #0f172a; border-color: #f59e0b; color: #fff; box-shadow: none; }
    .text-gold { color: #f59e0b; }
    .btn-gold-gradient { background: linear-gradient(135deg, #f59e0b, #d97706); border: none; color: #fff; }
    .btn-gold-gradient:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3); color: white; }
    .animate-fade-down { animation: fadeDown 0.8s forwards; }
    .animate-fade-up { animation: fadeUp 0.8s forwards; }
    @keyframes fadeDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection