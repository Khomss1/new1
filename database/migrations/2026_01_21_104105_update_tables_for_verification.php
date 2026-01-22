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
    // 1. Tambah Kolom di Tabel Jawaban
    Schema::table('jawaban', function (Blueprint $table) {
        $table->boolean('is_verified')->default(false); // Untuk Ceklis Admin
        $table->text('admin_notes')->nullable();       // Untuk Komentar Admin
    });

    // 2. Update Enum Status di Tabel Users (Menambah 'Menunggu Verifikasi' & 'Masa Sanggah')
    // Karena Laravel sulit ubah enum tanpa paket tambahan, kita pakai raw SQL
    DB::statement("ALTER TABLE users MODIFY status ENUM('Belum Mengisi', 'Sudah Mengisi', 'Menunggu Verifikasi', 'Masa Sanggah', 'Terverifikasi')");
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('jawaban', function (Blueprint $table) {
        $table->dropColumn(['is_verified', 'admin_notes']);
    });
    
    // Kembalikan enum ke asal
    DB::statement("ALTER TABLE users MODIFY status ENUM('Belum Mengisi', 'Sudah Mengisi', 'Terverifikasi')");
}
};
