<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Schedules extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_id',
        'doctor_id',
        'start_hour',
        'end_hour'
    ];

    public static function rules($id = null)
    {
        return [
            'day_id' => 'required|exists:days,id', // Asegura que el día exista en la tabla 'days'
            'doctor_id' => 'required|exists:doctors,id', // Asegura que el doctor exista en la tabla 'doctors'
            'start_hour' => 'required|date_format:H:i', // Valida el formato de la hora de inicio
            'end_hour' => 'required|date_format:H:i|after:start_hour', // Valida el formato de la hora de fin y que sea posterior a la hora de inicio
            'unique' => Rule::unique('schedules')->where(function ($query) use ($id) {
                $query->where('day_id', request('day_id'))
                    ->where('doctor_id', request('doctor_id'))
                    ->where('start_hour', request('start_hour'))
                    ->where('end_hour', request('end_hour'));
                if ($id) {
                    $query->ignore($id); // Ignora el registro actual en caso de actualización
                }
            }),
        ];
    }
    public function dayName()
    {
        return $this->day->name;
    }
    // Relación con Doctor (un horario pertenece a un doctor)
    public function doctor()
    {
        return $this->belongsTo(Doctor::class); // Ojo: 'doctor_id' debe existir en la tabla 'schedules'
    }

    // Relación con Day (un horario pertenece a un día)
    public function day()
    {
        return $this->belongsTo(Day::class); // Ojo: 'day_id' debe existir en la tabla 'schedules'
    }
}