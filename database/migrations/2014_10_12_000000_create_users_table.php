<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    
    // --- TAMBAHKAN BAGIAN INI ---
    $table->foreignId('id_kelas')->nullable(); 
    $table->string('nipd')->unique()->nullable(); // Nomor Induk Badan Publik
    $table->string('role')->default('bp'); // 'bp' untuk Badan Publik, 'admin' untuk Verifikator
    $table->string('pp')->nullable(); // Foto Profil
    $table->enum('status', ['Belum Mengisi', 'Sudah Mengisi', 'Terverifikasi'])->default('Belum Mengisi');
    // -----------------------------

    $table->rememberToken();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
