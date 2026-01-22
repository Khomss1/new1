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
    // 1. Tambah Status "Dikembalikan" ke Enum
    DB::statement("ALTER TABLE users MODIFY status ENUM('Belum Mengisi', 'Sudah Mengisi', 'Menunggu Verifikasi', 'Masa Sanggah', 'Dikembalikan', 'Terverifikasi')");

    // 2. Tambah Kolom Alasan Pengembalian
    Schema::table('users', function (Blueprint $table) {
        $table->text('catatan_pengembalian')->nullable();
    });
}

public function down(): void
{
    DB::statement("ALTER TABLE users MODIFY status ENUM('Belum Mengisi', 'Sudah Mengisi', 'Menunggu Verifikasi', 'Masa Sanggah', 'Terverifikasi')");
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('catatan_pengembalian');
    });
}
};
