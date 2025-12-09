<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanKeuangan extends Model
{
    use HasFactory;

    // === INI KUNCINYA ===
    // Kita harus mendaftarkan 'user_id' di sini supaya database mau menerimanya.
    protected $fillable = [
        'user_id',   // <--- PASTIKAN INI ADA!
        'tanggal',
        'deskripsi',
        'jenis',
        'nominal',
        'bukti',
    ];

    // Relasi ke User (Opsional tapi bagus)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}