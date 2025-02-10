<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prefixes = array("Admin", "Clinica", "Medico", "Paciente");

        foreach ($prefixes as $prefix) {
            Role::create([
                'name' => $prefix,
                'guard_name' => 'web'
            ]);
        }
    }
}