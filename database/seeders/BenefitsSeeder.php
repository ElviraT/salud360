<?php

namespace Database\Seeders;

use App\Models\Benefits;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BenefitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $benefits = array("Agendar Cita", "Consultas Online", "Consultorios Ilimitados", "20 Consultorios", "10 Consultorios", "Registro de medicos ilimitados", "Registro de 20 medicos", "Registro de 10 medicos", "Registro ilimitado de Pacientes", "Registro de 30 pacientes", "Registro de 15 pacientes", "Registro de historia medica", "Creación de 3 reportes personallizados", "Creación de 5 reportes personallizados", "Soporte Usuario", "Recordar de Citas", "Registro de Servicios Ilimitados", "Registro de 20 Servicios", "Registro de 10 Servicios", "Confirmar citas", "Registro de Gastos", "Creación de 2 modulos extras", "Creación de 1 modulo extra", "Facturación", "Registro de pagos");

        foreach ($benefits as $benefit) {
            Benefits::create([
                'name' => $benefit
            ]);
        }
    }
}