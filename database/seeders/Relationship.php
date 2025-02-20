<?php

namespace Database\Seeders;

use App\Models\Relationship as ModelsRelationship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Relationship extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pariente = array(
            "Padre",
            "Madre",
            "Hijo(a)",
            "Abuelo(a)",
            "Nieto(a)",
            "Hermano(a)",
            "Tío(a)",
            "Sobrino(a)",
            "Primo(a)",
            "Cónyuge",
        );


        foreach ($pariente as $prefix) {
            ModelsRelationship::create([
                'name' => $prefix,
            ]);
        }
    }
}