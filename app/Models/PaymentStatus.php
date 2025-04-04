<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',         // Nombre del estado (ej: "Pagado", "Pendiente")
        'color',        // Color para UI (ej: "success", "warning")
        'description',  // Descripción del estado
        'is_active'     // Si el estado está activo
    ];

    /**
     * Relación con las facturas que tienen este estado
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}