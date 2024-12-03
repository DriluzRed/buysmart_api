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
            'key' => 'auth_logo',
            'name' => 'Logo de Autenticación',
            'value' => '/img/logo.png',
            'description' => null,
            'field' => 'auth_logo',
            'active' => 1,
        ]);
        \App\Models\Setting::create
        ([
            'key' => 'navbar_logo',
            'name' => 'Logo del Navbar',
            'value' => '/img/logo_navbar.png',
            'description' => null,
            'field' => 'logo',
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
                            En {empresa}, valoramos y respetamos la privacidad de nuestros usuarios. Esta política explica cómo recogemos, usamos y protegemos la información personal que proporcionas al usar nuestros servicios.
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
                            Si tienes alguna pregunta sobre nuestra Política de Privacidad, no dudes en contactarnos a través de {contacto}.
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
            'value' => '<div class="container mt-5">
        <div class="text-center mb-5">
            <h2 class="display-4 text-warning">Términos de Servicio</h2>
            <p class="text-muted">Lee nuestros términos y condiciones para usar nuestros servicios.</p>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="card-title text-warning">Introducción</h4>
                        <p class="card-text">
                            Al acceder y usar nuestros servicios, aceptas cumplir con estos Términos de Servicio. Si no estás de acuerdo con estos términos, no utilices nuestros servicios.
                        </p>

                        <h4 class="card-title text-warning">Uso del Sitio Web</h4>
                        <p class="card-text">
                            El acceso a nuestro sitio web es para fines legales. No debes utilizar este sitio de manera que pueda dañar o interrumpir su funcionamiento. Nos reservamos el derecho de modificar o suspender el servicio en cualquier momento.
                        </p>

                        <h4 class="card-title text-warning">Registro de Cuenta</h4>
                        <p class="card-text">
                            Para acceder a ciertas funciones, como realizar compras, deberás registrarte en nuestro sitio y proporcionar información precisa y actualizada. Eres responsable de mantener la seguridad de tu cuenta.
                        </p>

                        <h4 class="card-title text-warning">Pedidos y Pagos</h4>
                        <p class="card-text">
                            Al realizar un pedido, aceptas pagar el precio total de los productos, más los costos de envío y cualquier impuesto aplicable. Todos los pagos se procesan de forma segura a través de nuestros proveedores de pago.
                        </p>

                        <h4 class="card-title text-warning">Devoluciones y Reembolsos</h4>
                        <p class="card-text">
                            Ofrecemos devoluciones de productos dentro de un plazo de 30 días después de la compra. Los productos deben estar en su estado original. Para más detalles, consulta nuestra política de devoluciones.
                        </p>

                        <h4 class="card-title text-warning">Propiedad Intelectual</h4>
                        <p class="card-text">
                            Todos los derechos de propiedad intelectual relacionados con el contenido de nuestro sitio web, incluidos los textos, imágenes y logotipos, son propiedad exclusiva de {empresa}. No se permite su reproducción sin nuestro permiso.
                        </p>

                        <h4 class="card-title text-warning">Limitación de Responsabilidad</h4>
                        <p class="card-text">
                            {empresa}, no será responsable por cualquier daño directo, indirecto, incidental o consecuente que surja del uso de nuestros servicios, incluido el acceso o uso del sitio web, productos, o la incapacidad de usarlo.
                        </p>

                        <h4 class="card-title text-warning">Modificaciones a los Términos</h4>
                        <p class="card-text">
                            Nos reservamos el derecho de modificar estos Términos de Servicio en cualquier momento. Te notificaremos sobre cambios importantes mediante un aviso en el sitio web. Es tu responsabilidad revisar los términos periódicamente.
                        </p>

                        <h4 class="card-title text-warning">Ley Aplicable</h4>
                        <p class="card-text">
                            Estos Términos de Servicio se rigen por las leyes de {pais}. Cualquier disputa relacionada con el uso de nuestros servicios se resolverá en los tribunales competentes de {pais}.
                        </p>

                        <h4 class="card-title text-warning">Contacto</h4>
                        <p class="card-text">
                            Si tienes alguna pregunta sobre estos Términos de Servicio, no dudes en ponerte en contacto con nosotros a través de {contacto}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>',
            'description' => 'terms',
            'field' => 'terms',
            'active' => 1,
        ]);

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

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@buysmart.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'ci' => '11111111',
            'phone' => '12345678',
            'birthdate' => '1990-01-01',
        ]);
    }

    
}
