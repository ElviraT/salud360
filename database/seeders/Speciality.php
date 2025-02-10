<?php

namespace Database\Seeders;

use App\Models\Speciality as ModelsSpeciality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Speciality extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = array(
            'Cardiología',
            'Dermatología',
            'Endocrinología',
            'Gastroenterología',
            'Ginecología',
            'Neurología',
            'Oftalmología',
            'Otorrinolaringología',
            'Pediatría',
            'Urología',
            'Neumología',
            'Traumatología',
        );


        foreach ($specialties as $prefix) {
            ModelsSpeciality::create([
                'name' => $prefix,
            ]);
        }
    }
}
