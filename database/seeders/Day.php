<?php

namespace Database\Seeders;

use App\Models\Day as ModelsDay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Day extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dias = array(
            "Lunes",
            "Martes",
            "Miércoles",
            "Jueves",
            "Viernes",
            "Sábado",
            "Domingo"
        );


        foreach ($dias as $prefix) {
            ModelsDay::create([
                'name' => $prefix,
            ]);
        }
    }
}
