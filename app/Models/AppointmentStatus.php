<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AppointmentStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',         // Nombre del estado (ej: "Confirmada", "Cancelada")
        'color',        // Color para representación visual (ej: "#00ff00")
    ];

    /**
     * Relación con las citas que tienen este estado
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'appointment_statuses_id');
    }
}