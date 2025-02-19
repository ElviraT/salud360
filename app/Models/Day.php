<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    // Relación con Shedules (un día tiene muchos horarios)
    public function Schedules()
    {
        return $this->hasMany(Schedules::class);
    }
}