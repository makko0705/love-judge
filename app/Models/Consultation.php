<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = ['user_name', 'partner_name'];

    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class);
    }
}
