<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\CatatanKeuangan; // Pastikan ini ada
use Illuminate\Http\Request; // Tambahkan ini jika belum ada

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',         // Admin, Petani, Mitra
        'status_akun',  // Aktif, Pending, Blokir (Wajib ada untuk fitur Mitra)
        'kontak',       // Opsional (Fitur Teman)
        'alamat',       // Opsional (Fitur Teman)
        'foto_profil', 
        'google_id', // Opsional (Fitur Teman)
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // RELASI KE CATATAN KEUANGAN
    public function catatan_keuangan()
    {
        return $this->hasMany(CatatanKeuangan::class, 'user_id', 'id');
    }

    // RELASI KE EVENT (Tambahan untuk Mitra)
    public function events()
    {
        return $this->hasMany(Event::class, 'user_id', 'id');
    }
    // Pastikan import Request di atas: use Illuminate\Http\Request;

public function scopeFilter(Builder $query, Request $request, array $filters = [], array $searchable = [])
{
    // 1. Logika Filter Biasa (Untuk kolom yang ada di tabel, misal: gender/role)
    foreach ($filters as $filter) {
        if ($request->filled($filter)) {
            $query->where($filter, $request->input($filter));
        }
    }

    // 2. Logika SEARCH (INI YANG BARU KITA TAMBAHKAN)
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request, $searchable) {
            foreach ($searchable as $column) {
                // Gunakan orWhere agar bisa cari di Name ATAU Email
                $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
            }
        });
    }

    return $query;
}
}
