@extends('layouts.guest.app')

@section('title', 'Edit User')

@section('content')
<div class="admin-wrapper" style="min-height: 100vh; background-color: #0f172a;">
    <div class="container px-4 py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="d-flex justify-content-between align-items-center mb-4 animate-fade-down">
                    <div>
                        <a href="{{ route('admin.users.index') }}" class="text-muted text-decoration-none small mb-2 d-block hover-text-blue">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <h2 class="text-white fw-bold mb-0">Edit Data Pengguna</h2>
                    </div>
                </div>

                <div class="card bg-dark-glass border-0 shadow-lg rounded-4 overflow-hidden animate-fade-up">
                    <div class="card-body p-5">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-blue small fw-bold ls-1">NAMA</label>
                                    <input type="text" name="name" class="form-control form-dark" value="{{ $user->name }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-blue small fw-bold ls-1">EMAIL</label>
                                    <input type="email" name="email" class="form-control form-dark" value="{{ $user->email }}" required>
                                </div>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-blue small fw-bold ls-1">ROLE</label>
                                    <select name="role" class="form-select form-dark">
                                        <option value="petani" {{ $user->role == 'petani' ? 'selected' : '' }}>Petani</option>
                                        <option value="mitra" {{ $user->role == 'mitra' ? 'selected' : '' }}>Mitra</option>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-blue small fw-bold ls-1">STATUS</label>
                                    <select name="status_akun" class="form-select form-dark">
                                        <option value="aktif" {{ $user->status_akun == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="pending" {{ $user->status_akun == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="blokir" {{ $user->status_akun == 'blokir' ? 'selected' : '' }}>Blokir</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-4 mb-5">
                                <div class="col-md-6">
                                    <label class="form-label text-blue small fw-bold ls-1">KONTAK</label>
                                    <input type="text" name="kontak" class="form-control form-dark" value="{{ $user->kontak }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-blue small fw-bold ls-1">PASSWORD BARU</label>
                                    <input type="password" name="password" class="form-control form-dark" placeholder="Opsional">
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-blue-gradient py-3 fw-bold shadow-blue">
                                    <i class="fas fa-save me-2"></i> SIMPAN PERUBAHAN
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
    .text-blue { color: #60a5fa; }
    .btn-blue-gradient { background: linear-gradient(135deg, #3b82f6, #2563eb); border: none; color: #fff; transition: 0.3s; }
    .btn-blue-gradient:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3); color: white; }
</style>
@endsection