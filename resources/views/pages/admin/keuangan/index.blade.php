@extends('layouts.guest.app')

@section('title', 'Rapor Keuangan Petani')

@section('content')
<div class="admin-wrapper" style="min-height: 100vh; background-color: #0f172a;">
    <div class="container-fluid px-4 py-5">
        
        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-5 animate-fade-down">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="text-muted text-decoration-none small mb-2 d-block hover-text-gold">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
                </a>
                <h2 class="text-white fw-bold mb-0">Master Data Keuangan</h2>
                <p class="text-gray-400 mb-0">Monitoring & Rapor Keuangan seluruh petani.</p>
            </div>
        </div>

        {{-- RINGKASAN GLOBAL --}}
        <div class="row g-4 mb-5 animate-fade-up">
            <div class="col-md-4">
                <div class="card bg-dark-glass border-0 p-4 position-relative overflow-hidden">
                    <h6 class="text-muted text-uppercase small fw-bold">Total Uang Masuk (Global)</h6>
                    <h3 class="text-success fw-bolder mb-0">Rp {{ number_format($systemMasuk, 0, ',', '.') }}</h3>
                    <i class="fas fa-arrow-up position-absolute bottom-0 end-0 text-success opacity-10 display-3 me-3"></i>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-dark-glass border-0 p-4 position-relative overflow-hidden">
                    <h6 class="text-muted text-uppercase small fw-bold">Total Uang Keluar (Global)</h6>
                    <h3 class="text-danger fw-bolder mb-0">Rp {{ number_format($systemKeluar, 0, ',', '.') }}</h3>
                    <i class="fas fa-arrow-down position-absolute bottom-0 end-0 text-danger opacity-10 display-3 me-3"></i>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-dark-glass border-0 p-4 position-relative overflow-hidden">
                    <h6 class="text-muted text-uppercase small fw-bold">Saldo Bersih Sistem</h6>
                    <h3 class="text-white fw-bolder mb-0">Rp {{ number_format($systemSaldo, 0, ',', '.') }}</h3>
                    <i class="fas fa-wallet position-absolute bottom-0 end-0 text-white opacity-10 display-3 me-3"></i>
                </div>
            </div>
        </div>

        {{-- === FILTER SECTION (BARU) === --}}
{{-- === FILTER & SEARCH SECTION === --}}
<div class="row mb-4 animate-fade-up" style="animation-delay: 0.1s;">
    <div class="col-md-12">
        <form method="GET" action="{{ route('admin.keuangan.index') }}">
            {{-- Input Hidden Page --}}
            @if(request('page'))
                <input type="hidden" name="page" value="{{ request('page') }}">
            @endif

            <div class="row g-3">
                {{-- 1. FILTER DROPDOWN --}}
                <div class="col-md-3">
                    <label class="text-gray-400 small fw-bold mb-2">Filter Status:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark-glass text-gray-400 border-end-0" style="border-color: #334155;">
                            <i class="fas fa-filter"></i>
                        </span>
                        <select name="status_keuangan" class="form-select bg-dark-glass text-white border-start-0 shadow-none" 
                                onchange="this.form.submit()" 
                                style="cursor: pointer; border-color: #334155;">
                            <option value="">Semua Status</option>
                            <option value="sultan" {{ request('status_keuangan') == 'sultan' ? 'selected' : '' }}>Sultan 👑</option>
                            <option value="sehat" {{ request('status_keuangan') == 'sehat' ? 'selected' : '' }}>Sehat</option>
                            <option value="defisit" {{ request('status_keuangan') == 'defisit' ? 'selected' : '' }}>Defisit ⚠️</option>
                        </select>
                    </div>
                </div>

                {{-- 2. SEARCH INPUT (Sesuai Modul) --}}
                <div class="col-md-4">
                    <label class="text-gray-400 small fw-bold mb-2">Cari Petani:</label>
                    <div class="input-group">
                        <input type="text" 
                               name="search" 
                               class="form-control bg-dark-glass text-white border-end-0"
                               placeholder="Nama atau Email..."
                               value="{{ request('search') }}"
                               style="border-color: #334155;">
                        
                        <button type="submit" class="btn btn-outline-secondary bg-dark-glass text-white border-start-0" style="border-color: #334155;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                {{-- TOMBOL RESET (Muncul jika sedang mencari/filter) --}}
                @if(request('search') || request('status_keuangan'))
                <div class="col-md-2 d-flex align-items-end">
                    <a href="{{ route('admin.keuangan.index') }}" class="btn btn-danger bg-opacity-25 border-danger text-danger w-100">
                        <i class="fas fa-times me-2"></i> Reset
                    </a>
                </div>
                @endif
            </div>
        </form>
    </div>
</div>
{{-- === END SECTION === --}}
        {{-- === END FILTER SECTION === --}}

        {{-- TABEL RINCIAN --}}
        <div class="card bg-dark-glass border-0 shadow-lg rounded-4 overflow-hidden animate-fade-up" style="animation-delay: 0.2s;">
            <div class="card-header bg-transparent border-bottom border-white-10 p-4">
                <h5 class="text-white mb-0"><i class="fas fa-users me-2 text-gold"></i> Rincian Per Petani</h5>
            </div>
            
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0 align-middle" style="background: transparent;">
                    <thead class="text-gray-400 text-uppercase small fw-bold" style="background: rgba(255,255,255,0.05);">
                        <tr>
                            <th class="py-4 ps-4">Nama Petani</th>
                            <th class="py-4 text-end">Pemasukan</th>
                            <th class="py-4 text-end">Pengeluaran</th>
                            <th class="py-4 text-end">Saldo Bersih</th>
                            <th class="py-4 text-center">Status Keuangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($petaniList as $petani)
                        @php
                            $saldo = $petani->total_masuk - $petani->total_keluar;
                        @endphp
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-3 fw-bold text-dark bg-gradient-green">
                                        {{ substr($petani->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="d-block fw-bold text-white">{{ $petani->name }}</span>
                                        <small class="text-gray-400">{{ $petani->email }}</small>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="text-end text-success fw-bold">
                                + Rp {{ number_format($petani->total_masuk ?? 0, 0, ',', '.') }}
                            </td>
                            
                            <td class="text-end text-danger fw-bold">
                                - Rp {{ number_format($petani->total_keluar ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="text-end text-white fw-bolder fs-6">
                                Rp {{ number_format($saldo, 0, ',', '.') }}
                            </td>

                            <td class="text-center">
                                @if($saldo > 5000000)
                                    <span class="badge bg-success bg-opacity-25 text-success border border-success rounded-pill px-3">Sultan 👑</span>
                                @elseif($saldo > 0)
                                    <span class="badge bg-info bg-opacity-25 text-info border border-info rounded-pill px-3">Sehat</span>
                                @elseif($saldo == 0)
                                    <span class="badge bg-secondary bg-opacity-25 text-light border border-secondary rounded-pill px-3">Kosong</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-25 text-danger border border-danger rounded-pill px-3">Defisit ⚠️</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- PAGINATION YANG SUDAH DIPERBAIKI (CENTER) --}}
            <div class="card-footer bg-transparent border-top border-white-10 py-4">
                <div class="d-flex justify-content-center">
                    {{-- Controller sudah menggunakan withQueryString(), jadi links() aman --}}
                    {{ $petaniList->links() }}
                </div>
            </div>

            @if($petaniList->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-user-slash fa-3x mb-3 opacity-25"></i>
                    <p>Belum ada data petani.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .bg-dark-glass { background-color: #1e293b; border: 1px solid #334155; }
    .table-dark { --bs-table-bg: transparent; --bs-table-hover-bg: rgba(255, 255, 255, 0.05); border-color: #334155; }
    .text-gray-400 { color: #94a3b8 !important; }
    .bg-gradient-green { background: linear-gradient(135deg, #66BB6A, #2E7D32); }
    .avatar-circle { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
    .hover-text-gold:hover { color: #f59e0b !important; }
    .border-white-10 { border-color: rgba(255,255,255,0.1) !important; }
    
    /* Styling tambahan untuk Select agar konsisten */
    .form-select option { background-color: #1e293b; color: white; }
    
    .animate-fade-down { animation: fadeDown 0.8s forwards; }
    .animate-fade-up { animation: fadeUp 0.8s forwards; opacity: 0; }
    @keyframes fadeDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection