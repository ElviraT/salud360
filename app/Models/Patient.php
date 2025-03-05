<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'marital_id',
        'sexes_id',
        'ocupation',
        'Date_of_birth',
        'dni',
        'phone',
        'address',
        'active',
        'created_by'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function marital()
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'id', 'patient_id');
    }
    public function healthInformation()
    {
        return $this->belongsTo(HealthInformation::class, 'id', 'patient_id');
    }
    public function informedConsent()
    {
        return $this->belongsTo(InformedConsent::class, 'id', 'patient_id');
    }

    public function antecedentes()
    {
        return $this->morphMany(MedicalHistory::class, 'paciente');
    }
}