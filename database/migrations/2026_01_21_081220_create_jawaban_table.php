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
        Schema::create('jawaban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            
            // Kolom Jawaban
            $table->text('jawaban_text')->nullable(); // Untuk jawaban teks
            $table->string('jawaban_file')->nullable(); // Untuk path file upload

            $table->timestamps(); // Pastikan ada titik koma di sini
        }); // <--- Kurung Kurawal Tutup untuk Schema::create
    } // <--- Kurung Kurawal Tutup untuk function up

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban');
    }
};