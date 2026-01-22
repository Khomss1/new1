<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['id_kelas', 'kategori', 'pertanyaan', 'status'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}