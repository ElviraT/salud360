<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable =
    [
        'user_id',
        'speciality_id',
        'first_name',
        'last_name',
        'clinic_id',
        'professional_license',
        'bio',
        'active',
        'photo',
    ];
}
