<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypesBackground extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function antecedentes()
    {
        return $this->hasMany(MedicalHistory::class, 'tipo_id');
    }
}