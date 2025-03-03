<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable =
    [
        'name',
        'description',
        'clinic_id',
        'price',
        'duration',
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
