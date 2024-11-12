<!DOCTYPE html>
<html>
<head>
    <title>Confirmación del Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            text-align: center;
            padding: 20px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            margin: 0 auto;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4CAF50;
        }
        h2 {
            color: #333;
            border-bottom: 2px solid #f4f4f9;
            padding-bottom: 5px;
        }
        p, li {
            font-size: 16px;
            line-height: 1.6;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        .order-item {
            background-color: #f9f9f9;
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            color: #4CAF50;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{asset('img/buysmart-logo-texto-sin-fondo.png')}}" alt="Logo" class="logo">
        <h1>¡Gracias por tu compra!</h1>
        <p>Tu pedido ha sido confirmado exitosamente.</p>
        <h2>Detalles del Pedido</h2>
        <p><strong>Nro del Pedido:</strong> {{ $data['order']->id }}</p>
        <p><strong>Fecha del Pedido:</strong> {{ $data['order']->created_at }}</p>
        <h3>Productos</h3>
        <ul>
            @foreach($data['orderItem'] as $item)
                <li class="order-item">
                    <p><strong>Producto:</strong> {{ $item['item_name'] }}</p>
                    <p><strong>Precio:</strong> {{ \App\Helpers\Helper::formatPrice($item['price']) }}</p>
                    <p><strong>Cantidad:</strong> {{ $item['quantity'] }}</p>
                </li>
            @endforeach
        </ul>
        <p><strong>Estado del Pedido:</strong> {{ $data['order']->status_translated }}</p>
        <p class="total"><strong>Monto del Delivery:</strong> {{ \App\Helpers\Helper::formatPrice(\App\Helpers\Helper::getDeliveryCost()) }}</p>
        <p class="total"><strong>Total:</strong> {{  \App\Helpers\Helper::formatPrice($data['order']->total) }}</p>
        
    </div>
</body>
</html>
