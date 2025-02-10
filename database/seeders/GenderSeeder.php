<?php

namespace Database\Seeders;

use App\Models\Sex;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = array("Masculino", "Femenino", "Otro", "No Responder");

        foreach ($genders as $item) {
            Sex::create([
                'name' => $item,
            ]);
        }
    }
}