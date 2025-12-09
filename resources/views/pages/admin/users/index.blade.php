@extends('layouts.guest.app')

@section('title', 'Manajemen User')

@section('content')
<div class="admin-wrapper" style="min-height: 100vh; background-color: #0f172a;">
    <div class="container px-4 py-5">

        {{-- HEADER PAGE --}}
        <div class="d-flex justify-content-between align-items-center mb-4 animate-fade-down">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="text-muted text-decoration-none small mb-2 d-block hover-text-gold">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
                </a>
                <h2 class="text-white fw-bold mb-0">Data Pengguna</h2>
                <p class="text-gray-400 mb-0">Kelola semua akun yang terdaftar di sistem.</p>
            </div>
            <div>
                <a href="{{ route('admin.users.create') }}" class="btn btn-gold-gradient py-2 px-4 fw-bold shadow-gold rounded-pill">
                    <i class="fas fa-plus me-2"></i> Tambah User
                </a>
            </div>
        </div>

       {{-- === FILTER & SEARCH SECTION === --}}
<div class="row mb-4 animate-fade-down">
    <div class="col-md-12">
        <form method="GET" action="{{ route('admin.users.index') }}">
            {{-- Input Hidden Page (Agar pagination tidak reset saat filter) --}}
            @if(request('page'))
                <input type="hidden" name="page" value="{{ request('page') }}">
            @endif

            <div class="row g-3">
                {{-- 1. FILTER ROLE --}}
                <div class="col-md-3">
                    <label class="text-gray-400 small fw-bold mb-2">Filter Role:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark-glass text-gray-400 border-end-0" style="border-color: #334155;">
                            <i class="fas fa-filter"></i>
                        </span>
                        <select name="role" class="form-select bg-dark-glass text-white border-start-0 shadow-none" 
                                onchange="this.form.submit()" 
                                style="cursor: pointer; border-color: #334155;">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="mitra" {{ request('role') == 'mitra' ? 'selected' : '' }}>Mitra</option>
                            <option value="petani" {{ request('role') == 'petani' ? 'selected' : '' }}>Petani</option>
                        </select>
                    </div>
                </div>

                {{-- 2. SEARCH INPUT --}}
                <div class="col-md-4">
                    <label class="text-gray-400 small fw-bold mb-2">Cari User:</label>
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

                {{-- 3. TOMBOL RESET --}}
                @if(request('search') || request('role'))
                <div class="col-md-2 d-flex align-items-end">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-danger bg-opacity-25 border-danger text-danger w-100">
                        <i class="fas fa-times me-2"></i> Reset
                    </a>
                </div>
                @endif
            </div>
        </form>
    </div>
</div>
{{-- === END SECTION === --}}
        {{-- === END BAGIAN FILTER === --}}

        @if(session('success'))
        <div class="alert alert-success bg-success bg-opacity-25 text-success border-0 rounded-4 mb-4 animate-fade-up">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
        @endif

        <div class="card bg-dark-glass border-0 shadow-lg rounded-4 overflow-hidden animate-fade-up">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0 align-middle" style="background: transparent;">
                    <thead class="text-gray-400 text-uppercase small fw-bold" style="background: rgba(255,255,255,0.05);">
                        <tr>
                            <th class="py-4 ps-4">Nama Pengguna</th>
                            <th class="py-4">Role</th>
                            <th class="py-4">Email</th>
                            <th class="py-4">Bergabung</th>
                            <th class="py-4 text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            {{-- BAGIAN NAMA --}}
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    @php
                                    $avatarClass = 'bg-gradient-green';
                                    if($user->role == 'admin') $avatarClass = 'bg-gradient-gold';
                                    if($user->role == 'mitra') $avatarClass = 'bg-gradient-blue';
                                    @endphp

                                    <div class="avatar-circle me-3 fw-bold text-dark {{ $avatarClass }}">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span class="fw-bold text-white">{{ $user->name }}</span>
                                </div>
                            </td>

                            {{-- BAGIAN ROLE --}}
                            <td>
                                @if($user->role == 'admin')
                                <span class="badge bg-warning text-dark border border-warning border-opacity-50 rounded-pill px-3">
                                    Admin
                                </span>
                                @elseif($user->role == 'mitra')
                                <span class="badge bg-info bg-opacity-20 text-info border border-info border-opacity-25 rounded-pill px-3">
                                    Mitra
                                </span>
                                @else
                                <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-25 rounded-pill px-3">
                                    Petani
                                </span>
                                @endif
                            </td>

                            {{-- BAGIAN EMAIL & LAINNYA --}}
                            <td class="text-gray-400">{{ $user->email }}</td>
                            <td class="text-gray-400 small">
                                {{ $user->created_at?->format('d M Y') }}
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-light rounded-circle" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle delete-confirm" title="Hapus" onclick="return confirm('Yakin hapus user ini?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                {{-- PAGINATION --}}
                <div class="d-flex justify-content-center mt-4 mb-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* --- ADMIN STYLES --- */
    .bg-dark-glass {
        background-color: #1e293b;
        border: 1px solid #334155;
    }

    .table-dark {
        --bs-table-bg: transparent;
        --bs-table-hover-bg: rgba(255, 255, 255, 0.05);
        border-color: #334155;
    }

    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .text-gray-400 {
        color: #94a3b8 !important;
    }

    .btn-gold-gradient {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border: none;
        color: #fff;
        transition: 0.3s;
    }

    .btn-gold-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
        color: white;
    }

    .animate-fade-down {
        animation: fadeDown 0.8s forwards;
    }

    .animate-fade-up {
        animation: fadeUp 0.8s forwards;
    }

    @keyframes fadeDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* GRADIENT CLASSES */
    .bg-gradient-green {
        background: linear-gradient(135deg, #66BB6A, #2E7D32);
    }

    .bg-gradient-gold {
        background: linear-gradient(135deg, #FFD700, #FF8C00);
    }

    .bg-gradient-blue {
        background: linear-gradient(135deg, #4FC3F7, #0288D1);
    }
    
    /* STYLE TAMBAHAN KHUSUS SELECT FILTER (Agar Rapi) */
    .form-select option {
        background-color: #1e293b; /* Warna background option saat dropdown dibuka */
        color: white;
    }
</style>
@endsection