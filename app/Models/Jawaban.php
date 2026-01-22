<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';
    protected $fillable = ['user_id', 'question_id', 'jawaban_text', 'jawaban_file'];

    // --- TAMBAHKAN RELASI INI ---
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
    // -----------------------------
}