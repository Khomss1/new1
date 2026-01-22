<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'kuesioner_id', 
        'score_digitalisasi', 
        'score_jenis_informasi', 
        'score_kualitas', 
        'score_komitmen', 
        'score_sarana', 
        'total_score', 
        'verifikator_notes', 
        'status'
    ];

    /**
     * Penilaian ini milik siapa? (User/Badan Publik)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}