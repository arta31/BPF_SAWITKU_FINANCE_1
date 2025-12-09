<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            // 1. Email
            $table->string('email')->unique();

            // 2. Tambahkan Google ID disini (Boleh Kosong)
            $table->string('google_id')->nullable();

            $table->timestamp('email_verified_at')->nullable();

            // 3. Password jadi Boleh Kosong (nullable)
            $table->string('password')->nullable();

            // Role & Data Lain (Sesuai kodingan kamu sebelumnya)
            $table->enum('role', ['admin', 'petani', 'mitra'])->default('petani');
            $table->enum('status_akun', ['aktif', 'nonaktif', 'pending', 'blokir'])->default('aktif');
            $table->string('kontak')->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto_profil')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });


        // ... kode tabel session dll biarkan saja ...
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
