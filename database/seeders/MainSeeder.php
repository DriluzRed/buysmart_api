<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Setting::create([
            'key' => 'delivery_cost',
            'name' => 'Costo del Delivery',
            'value' => '50000',
            'description' => null,
            'field' => 'delivery_cost',
            'active' => 1,
        ]);

        \App\Models\Setting::create([
            'key' => 'faqs',
            'name' => 'FAQS',
            'value' => '[
                {
                    "question": "¿Cómo hago un pedido?",
                    "answer": "Para hacer un pedido, simplemente navega por nuestra tienda en línea, selecciona los productos que deseas comprar y agrégalos al carrito de compras. Luego, sigue los pasos para completar tu pedido."
                },
                {
                    "question": "¿Cuánto tiempo tarda en llegar mi pedido?",
                    "answer": "El tiempo de entrega de tu pedido dependerá de tu ubicación y del método de envío que elijas. Por lo general, los pedidos se entregan en un plazo de 3 a 7 días hábiles."
                },
                {
                    "question": "¿Puedo devolver un producto?",
                    "answer": "Sí, aceptamos devoluciones de productos en su estado original y sin usar en un plazo de 30 días a partir de la fecha de compra. Para obtener más información, consulta nuestra política de devoluciones."
                },
                {
                    "question": "¿Cómo puedo contactar con el servicio de atención al cliente?",
                    "answer": "Puedes ponerte en contacto con nuestro servicio de atención al cliente a través de nuestro correo electrónico o por teléfono. Estamos aquí para ayudarte con cualquier pregunta o inquietud que puedas tener."
                }
            ]
            ',
            'description' => 'preguntas frecuentes',
            'field' => 'faq',
            'active' => 1,
        ]);
        \App\Models\Setting::create([
            'key' => 'security',
            'name' => 'Politica de Seguridad',
            'value' => '<div class="container mt-5">
                <div class="text-center mb-5">
                    <h2 class="display-4 text-success">Política de Privacidad</h2>
                    <p class="text-muted">Entiende cómo protegemos tu información personal.</p>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <h4 class="card-title text-success">Introducción</h4>
                                <p class="card-text">
                                    En [Nombre de la Empresa], valoramos y respetamos la privacidad de nuestros usuarios. Esta política explica cómo recogemos, usamos y protegemos la información personal que proporcionas al usar nuestros servicios.
                                </p>

                                <h4 class="card-title text-success">¿Qué Información Recopilamos?</h4>
                                <p class="card-text">
                                    Recopilamos información personal cuando te registras en nuestro sitio web, realizas un pedido, o interactúas con nuestro servicio de atención al cliente. Esta información puede incluir tu nombre, dirección, correo electrónico, número de teléfono y detalles de pago.
                                </p>

                                <h4 class="card-title text-success">Uso de la Información</h4>
                                <p class="card-text">
                                    Utilizamos la información personal para procesar tus pedidos, proporcionarte soporte, y mejorar nuestros servicios. También podemos utilizarla para enviarte actualizaciones sobre productos y ofertas, siempre y cuando nos des tu consentimiento.
                                </p>

                                <h4 class="card-title text-success">Protección de la Información</h4>
                                <p class="card-text">
                                    Implementamos medidas de seguridad razonables para proteger la información personal que recopila nuestra empresa. Sin embargo, ten en cuenta que ninguna transmisión de datos a través de Internet es 100% segura, por lo que no podemos garantizar la seguridad absoluta.
                                </p>

                                <h4 class="card-title text-success">Compartir Información con Terceros</h4>
                                <p class="card-text">
                                    No compartimos tu información personal con terceros sin tu consentimiento, salvo en situaciones específicas como procesadores de pagos y proveedores de servicios que nos ayudan a completar tu pedido.
                                </p>

                                <h4 class="card-title text-success">Tus Derechos</h4>
                                <p class="card-text">
                                    Tienes el derecho de acceder, corregir o eliminar la información personal que tenemos sobre ti. Si deseas ejercer estos derechos, por favor contáctanos.
                                </p>

                                <h4 class="card-title text-success">Cambios a Esta Política</h4>
                                <p class="card-text">
                                    Nos reservamos el derecho de actualizar esta Política de Privacidad en cualquier momento. Te notificaremos de cualquier cambio mediante un aviso en nuestro sitio web.
                                </p>

                                <h4 class="card-title text-success">Contacto</h4>
                                <p class="card-text">
                                    Si tienes alguna pregunta sobre nuestra Política de Privacidad, no dudes en contactarnos a través de [correo electrónico/contacto].
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>',
            'description' => null,
            'field' => 'security',
            'active' => 1,
        ]);

        \App\Models\Setting::create([
            'key' => 'terms',
            'name' => 'Terminos de Servicio',
            'value' => null,
            'description' => 'terms',
            'field' => 'terms',
            'active' => 1,
        ]);

        \App\Models\PaymentMethod::create([
            'name' => 'Pago contra entrega',
            'description' => 'Pago en efectivo o tarjeta al momento de la entrega',
            'image' => 'cash-on-delivery.png',
            'active' => 1,
        ]);

        \App\Models\PaymentMethod::create([
            'name' => 'Tarjeta de Debito/Credito',
            'description' => 'Pago con tarjeta de débito o crédito',
            'image' => 'credit-card.png',
            'active' => 1,
        ]);

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@buysmart.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'active' => 1,
            'ci' => '11111111',
            'phone ' => '12345678',
            'birthdate ' => '1990-01-01',
        ]);

        \App\Models\Customer::create([
            'name' => 'Customer',
            'email' => 'customer@buysmart.com',
            'phone' => '12345678',
            'ci' => '11111111',
            'ruc' => '11111111-1',
            'birthdate' => '1990-01-01',
            'password' => Hash::make('123456'),
        ]);
    }

    
}
