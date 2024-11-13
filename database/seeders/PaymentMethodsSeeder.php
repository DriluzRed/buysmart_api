<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PaymentMethod::create([
            'name' => 'Pago contra entrega',
            'description' => 'Pago en efectivo o tarjeta al momento de la entrega',
            'image' => 'cash-on-delivery.png',
            'is_active' => 1,
        ]);

        \App\Models\PaymentMethod::create([
            'name' => 'Tarjeta de Debito/Credito',
            'description' => 'Pago con tarjeta de débito o crédito',
            'image' => 'credit-card.png',
            'is_active' => 1,
        ]);
    }
}
