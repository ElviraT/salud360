<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $method = array("Efectivo", "Transferencia", "Pago Movil");

        foreach ($method as $item) {
            PaymentMethod::create([
                'name' => $item,
            ]);
        }
    }
}