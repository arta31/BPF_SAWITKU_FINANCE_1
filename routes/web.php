<?php

use Illuminate\Support\Facades\Route;

// Import semua Controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Guest\CatatanKeuanganController;
use App\Http\Controllers\Guest\ForgotPasswordController;
// Controller Admin
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Mitra\EventMitraController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. HALAMAN DEPAN (Landing Page)
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/auth/redirect-google', [AuthController::class, 'redirectToGoogle'])->name('redirect.google');
Route::get('/oauthcallback', [AuthController::class, 'handleGoogleCallback']);

// 2. RUTE UNTUK TAMU (Belum Login)
Route::middleware(['guest'])->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    // Lupa Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // Reset Password
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');
});


// 3. RUTE UNTUK USER (Sudah Login)
Route::middleware(['auth'])->group(function () {

    // Dashboard Petani (Controller Guest)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('guest.dashboard');

    // CRUD Catatan Keuangan
    Route::resource('catatan-keuangan', CatatanKeuanganController::class);

    // Laporan Keuangan
    Route::get('/laporan', [CatatanKeuanganController::class, 'laporan'])->name('catatan-keuangan.laporan');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// 4. RUTE KHUSUS ADMIN
// Hanya bisa diakses jika login DAN role = admin
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Manajemen User (CRUD User)
    Route::resource('users', UserController::class);

    // ... di dalam group middleware admin ...

    // MASTER DATA KEUANGAN
    Route::get('/keuangan', [App\Http\Controllers\Admin\AdminKeuanganController::class, 'index'])->name('keuangan.index');
    Route::delete('/keuangan/{id}', [App\Http\Controllers\Admin\AdminKeuanganController::class, 'destroy'])->name('keuangan.destroy');

    // ... Di dalam Route::middleware(['auth', 'is_admin'])...

    // MASTER DATA KEUANGAN (RAPOR PETANI)
    Route::get('/keuangan-petani', [App\Http\Controllers\Admin\AdminKeuanganController::class, 'index'])->name('keuangan.index');

    // ...
    // ...
    // Manajemen Event Mitra (Jika nanti dibutuhkan)
    // Route::resource('events', EventController::class);
    // ... Di dalam Route::middleware(['auth', 'is_admin'])...

    // MANAJEMEN EVENT
    Route::get('/events', [App\Http\Controllers\Admin\EventController::class, 'index'])->name('events.index');
    Route::delete('/events/{id}', [App\Http\Controllers\Admin\EventController::class, 'destroy'])->name('events.destroy');

    // Route Tombol Aksi
    Route::patch('/events/{id}/approve', [App\Http\Controllers\Admin\EventController::class, 'approve'])->name('events.approve');
    Route::patch('/events/{id}/reject', [App\Http\Controllers\Admin\EventController::class, 'reject'])->name('events.reject');

    // ... route admin lain ...

    // PENGATURAN WEBSITE
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

// === RUTE KHUSUS MITRA ===
// Hanya bisa diakses jika login DAN role = mitra
// Kita perlu buat middleware 'is_mitra' dulu nanti
// === RUTE KHUSUS MITRA ===
// === RUTE KHUSUS MITRA ===
Route::middleware(['auth', 'is_mitra'])->prefix('mitra')->name('mitra.')->group(function () {

    // Dashboard Mitra
    Route::get('/dashboard', [App\Http\Controllers\Mitra\MitraDashboardController::class, 'index'])->name('dashboard');

    // Manajemen Event (CRUD Punya Mitra)
    // Ini akan membuat route bernama: mitra.events.index, mitra.events.create, mitra.events.store, dll
    Route::resource('events', App\Http\Controllers\Mitra\EventMitraController::class);
});

Route::get('/test1', function () {
    return 'Test route is working!';
});
