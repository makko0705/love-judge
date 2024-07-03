<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    protected $fillable = ['consultation_id', 'diagnosis_content', 'love_possibility', 'go_or_wait'];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
}
