<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk proses login
use Illuminate\Support\Facades\Hash; // Untuk enkripsi password
use Illuminate\Support\Facades\Log;  // Untuk logging error
use App\Models\User; // Panggil Model User
use Laravel\Socialite\Facades\Socialite; // Untuk Socialite Google

class AuthController extends Controller
{
    //========================================================
    // 1. TAMPILKAN FORM LOGIN
    //========================================================
    public function showLogin()
    {
        return view('login-form');
    }

    //========================================================
    // 2. PROSES LOGIN BIASA (Email & Password)
    //========================================================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            session(['username' => Auth::user()->name]);

            return $this->redirectBasedOnRole(Auth::user());
        }

        return back()->with('error', 'Login gagal! Email atau Password salah.');
    }

    //========================================================
    // 3. TAMPILKAN FORM REGISTER
    //========================================================
    public function showRegister()
    {
        return view('register-form');
    }

    //========================================================
    // 4. PROSES REGISTER BIASA
    //========================================================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petani', // Default role
        ]);

        Auth::login($user);
        session(['username' => $user->name]);

        return redirect()->route('guest.dashboard');
    }

    //========================================================
    // 5. LOGOUT
    //========================================================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    //========================================================
    // 6. REDIRECT KE GOOGLE (INI YANG TADI HILANG)
    //========================================================
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    //========================================================
    // 7. CALLBACK DARI GOOGLE
    //========================================================
    public function handleGoogleCallback()
    {
        try {
            // Ambil user dari Google
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Cek apakah user sudah ada berdasarkan email
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // User Ada: Update Google ID jika kosong & Login
                if (empty($user->google_id)) {
                    $user->update(['google_id' => $googleUser->id]);
                }

                Auth::login($user);
                session(['username' => $user->name]);

                return $this->redirectBasedOnRole($user);
            } else {
                // User Baru: Register Otomatis
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'role' => 'petani', // Default role
                    'password' => null, // Password kosong
                    'email_verified_at' => now(),
                ]);

                Auth::login($newUser);
                session(['username' => $newUser->name]);

                return redirect()->route('guest.dashboard');
            }
        } catch (\Exception $e) {
            // Jika error, kembalikan ke login dengan pesan
            return redirect()->route('login')
                ->with('error', 'Gagal Login Google: ' . $e->getMessage());
        }
    }

    //========================================================
    // HELPER: REDIRECT SESUAI ROLE
    //========================================================
    protected function redirectBasedOnRole($user)
    {
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        } elseif ($user->role === 'mitra') {
            return redirect()->intended(route('mitra.dashboard'));
        } else {
            return redirect()->intended(route('guest.dashboard'));
        }
    }
}
