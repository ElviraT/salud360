<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable =
    [
        'user_id',
        'speciality_id',
        'name',
        'clinic_id',
        'professional_license',
        'bio',
        'active',
        'created_by'
    ];
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }
    // Relación con Schedules (un doctor tiene muchos horarios)
    public function Schedules()
    {
        return $this->hasMany(Schedules::class);
    }
}