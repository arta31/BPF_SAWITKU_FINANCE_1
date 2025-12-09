<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\CatatanKeuangan;
use App\Models\Event;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BERSIHKAN DATA LAMA (Opsional, tapi bagus biar bersih)
        // User::truncate(); 
        // CatatanKeuangan::truncate();
        // Event::truncate();

        // -------------------------------------------
        // A. BUAT USER ADMIN
        // -------------------------------------------
        User::create([
            'name' => 'Administrator Sawit',
            'email' => 'admin@sawitku.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status_akun' => 'aktif', // Pastikan nama kolom di DB 'status_akun' atau 'status'? Cek Model User Anda!
        ]);

        // -------------------------------------------
        // B. BUAT USER MITRA
        // -------------------------------------------
        $mitra = User::create([
            'name' => 'Mitra Pupuk Jaya',
            'email' => 'mitra2@sawitku.com',
            'password' => Hash::make('mitra123'),
            'role' => 'mitra',
            'status_akun' => 'aktif',
        ]);

        // Buat Event Mitra
        Event::create([
            'user_id' => $mitra->id,
            'nama_event' => 'Promo Diskon Pupuk 50%',
            'tanggal' => Carbon::now()->addDays(5),
            'deskripsi' => 'Dapatkan potongan harga spesial untuk pembelian pupuk NPK.',
            'lokasi' => 'Gudang Pupuk Jaya',
            'status' => 'approved'
        ]);
        
        Event::create([
            'user_id' => $mitra->id,
            'nama_event' => 'Penyuluhan Hama',
            'tanggal' => Carbon::now()->addDays(12),
            'deskripsi' => 'Seminar gratis cara mengatasi serangan kumbang.',
            'lokasi' => 'Balai Desa',
            'status' => 'pending'
        ]);

        // -------------------------------------------
        // C. BUAT USER PETANI & TRANSAKSINYA
        // -------------------------------------------
        $petani = User::create([
            'name' => 'Gilang Juragan',
            'email' => 'gilang@sawitku.com',
            'password' => Hash::make('password123'),
            'role' => 'petani',
            'status_akun' => 'aktif',
        ]);

        // Buat 50 Transaksi Keuangan
        for ($i = 0; $i < 50; $i++) {
            $jenis = rand(0, 1) ? 'pemasukan' : 'pengeluaran';
            CatatanKeuangan::create([
                'user_id'   => $petani->id,
                'tanggal'   => Carbon::now()->subDays(rand(0, 30)),
                'deskripsi' => $jenis == 'pemasukan' ? 'Panen Sawit' : 'Beli Pupuk',
                'jenis'     => $jenis,
                'nominal'   => rand(100000, 5000000),
                'bukti'     => null,
            ]);
        }
    }
}