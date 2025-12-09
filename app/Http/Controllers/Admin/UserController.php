<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
{
    // 1. Filter: Role (Sudah ada sebelumnya)
    $filterableColumns = ['role'];

    // 2. Search: Nama & Email (INI BARU)
    $searchableColumns = ['name', 'email'];

    $users = User::latest()
        // Panggil filter dengan parameter ke-3 untuk search
        ->filter($request, $filterableColumns, $searchableColumns) 
        ->paginate(10)
        ->withQueryString(); // Agar filter/search nempel pas ganti halaman

    return view('pages.admin.users.index', compact('users'));
}
    public function create()
    {
        return view('pages.admin.users.create');
    }

    public function store(Request $request)
    {
        // Validasi Standar Aja
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,petani,mitra',
            // TAMBAHKAN INI: Set default 'aktif' jika yang dibuat adalah Mitra
            'status_akun' => ($request->role === 'mitra') ? 'aktif' : 'aktif',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,petani,mitra',
        ]);

        $data = $request->only(['name', 'email', 'role']);

        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }
        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (auth()->id() == $user->id) {
            return back()->with('error', 'Gak bisa hapus diri sendiri bos!');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User dihapus');
    }
}
