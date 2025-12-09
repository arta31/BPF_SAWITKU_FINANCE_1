<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('pages.admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:50',
            'logo'     => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $setting = Setting::first();
        $data = ['app_name' => $request->app_name];

        // Logika Upload Logo
        if ($request->hasFile('logo')) {
            // 1. Hapus logo lama jika ada
            if ($setting->logo && Storage::exists('public/' . $setting->logo)) {
                Storage::delete('public/' . $setting->logo);
            }
            
            // 2. Simpan logo baru
            $path = $request->file('logo')->store('settings', 'public');
            $data['logo'] = $path;
        }

        $setting->update($data);

        return back()->with('success', 'Pengaturan aplikasi berhasil diupdate!');
    }
}