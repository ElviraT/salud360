<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fields',
    ];

    protected $casts = [
        'fields' => 'array',
    ];

    // public function medicalHistories()
    // {
    //     return $this->hasMany(MedicalHistory::class);
    // }
}
