<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'patient_type',
        'type_id',
        'description',
        'diagnosis_date',
        'related_medications',
        'related_allergies',
        'notes',
    ];

    public function paciente()
    {
        return $this->morphTo();
    }

    public function tipo()
    {
        return $this->belongsTo(TypesBackground::class, 'type_id');
    }
}