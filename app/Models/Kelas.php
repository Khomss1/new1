<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kelas', 'jurusan', 'tahun'];

    /**
     * Satu Kelas memiliki banyak User (Badan Publik)
     */
    public function users()
    {
        return $this->hasMany(User::class, 'id_kelas');
    }

    /**
     * Satu Kelas memiliki banyak Pertanyaan (Kuesioner)
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'id_kelas');
    }
}