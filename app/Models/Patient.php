<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;


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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function marital(): BelongsTo
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'id', 'patient_id');
    }

    public function healthInformation(): BelongsTo
    {
        return $this->belongsTo(HealthInformation::class, 'id', 'patient_id');
    }

    public function informedConsent(): BelongsTo
    {
        return $this->belongsTo(InformedConsent::class, 'id', 'patient_id');
    }

    public function medicalHistories(): MorphMany
    {
        return $this->morphMany(MedicalHistory::class, 'paciente');
    }
}