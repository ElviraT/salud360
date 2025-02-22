<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthInformation extends Model
{
    protected $fillable = [
        'patient_id',
        'blood_group',
        'allergies',
        'medical_condition',
        'medication',
    ];
}
