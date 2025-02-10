<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanBenefits extends Model
{
    use HasFactory;

    protected $table = 'plan_benefits'; // Especifica el nombre de la tabla
    protected $fillable = [
        'plan_id',
        'benefit_id'
    ];

    // Opcional: Puedes agregar métodos para acceder a los modelos relacionados
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function benefit()
    {
        return $this->belongsTo(Benefits::class);
    }
}