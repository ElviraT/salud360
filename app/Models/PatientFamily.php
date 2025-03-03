<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientFamily extends Model
{
    protected $fillable =
    [
        'patient_id',
        'sexes_id',
        'relationship_id',
        'name',
        'dni',
        'phone_number',
        'email',
        'Date_of_birth',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function relation()
    {
        return $this->belongsTo(Relationship::class, 'relationship_id');
    }
}