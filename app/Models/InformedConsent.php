<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformedConsent extends Model
{
    protected $fillable = [
        'patient_id',
        'telemedicine',
        'data_collection',
    ];
}
