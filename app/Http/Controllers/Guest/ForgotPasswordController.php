<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    // 1. TAMPILKAN FORM LUPA PASSWORD
    public function showLinkRequestForm()
    {
        return view('pages.guest.forgot-password');
    }

    // 2. PROSES KIRIM EMAIL (KE LOG)
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Link reset password sudah dikirim! Cek Log/Email Anda.');
        }

        return back()->withErrors(['email' => 'Email tidak ditemukan di database kami.']);
    }

    // 3. TAMPILKAN FORM GANTI PASSWORD BARU
    public function showResetForm(Request $request, $token = null)
    {
        return view('pages.guest.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // 4. PROSES SIMPAN PASSWORD BARU
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        });

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Password berhasil diubah! Silahkan login.');
        }

        return back()->withErrors(['email' => 'Gagal mereset password. Pastikan email benar.']);
    }
}