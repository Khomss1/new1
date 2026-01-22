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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
             // Relasi ke User (Badan Publik)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        // Skor Indikator
        $table->float('score_digitalisasi')->default(0);
        $table->float('score_jenis_informasi')->default(0);
        $table->float('score_kualitas')->default(0);
        $table->float('score_komitmen')->default(0);
        $table->float('score_sarana')->default(0);
        
        // Total & Catatan
        $table->float('total_score')->default(0);
        $table->text('verifikator_notes')->nullable();
        
        // Status
        $table->enum('status', ['Draft', 'Verified', 'Published'])->default('Draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
