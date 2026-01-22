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
    // 1. Tambah Status "Telah Diperbaiki"
    DB::statement("ALTER TABLE users MODIFY status ENUM('Belum Mengisi', 'Sudah Mengisi', 'Menunggu Verifikasi', 'Telah Diperbaiki', 'Dikembalikan', 'Terverifikasi')");

    // 2. Tambah Kolom Total Nilai di tabel Users
    Schema::table('users', function (Blueprint $table) {
        $table->float('total_score')->default(0);
    });
}

public function down(): void
{
    DB::statement("ALTER TABLE users MODIFY status ENUM('Belum Mengisi', 'Sudah Mengisi', 'Menunggu Verifikasi', 'Masa Sanggah', 'Dikembalikan', 'Terverifikasi')");
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('total_score');
    });
}
};
