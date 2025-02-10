<?php

namespace Database\Seeders;

use App\Models\MaritalStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaritalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maritals = array("Soltero(a)", "Casado(a)", "Divorciado(a)", "Viudo(a)");

        foreach ($maritals as $item) {
            MaritalStatus::create([
                'name' => $item,
            ]);
        }
    }
}