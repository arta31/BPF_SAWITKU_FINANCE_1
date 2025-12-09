<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. PENGATURAN PAGINATION
        Paginator::useBootstrapFive(); 

        // 2. REGISTRASI CUSTOM VALIDATION RULE 'aktif'
        Validator::extend('aktif', function ($attribute, $value, $parameters, $validator) {
            // Logika: Memastikan nilai field (misalnya 'status_akun') sama dengan 'aktif'
            return $value === 'aktif';
        });

        // 3. BAGI DATA SETTING KE SEMUA VIEW
        try {
            $setting = Setting::first();
            // Jika database kosong, buat objek kosong agar tidak error property access
            if (!$setting) {
                $setting = new Setting();
                $setting->app_name = 'SawitKu';
            }
            View::share('appSetting', $setting);
        } catch (\Exception $e) {
            // Biarkan kosong, ini untuk menangani saat command 'php artisan migrate' dijalankan
        }
    }
}