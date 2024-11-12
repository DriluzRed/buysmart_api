@extends('frontend.layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2 class="mb-4">Detalles del Pedido</h2>

                <!-- Información básica del pedido -->
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Pedido #{{ $order->id }}</h5>
                        <small>Fecha: {{ $order->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    <div class="card-body">
                        <p><strong>Estado del pedido:</strong> 
                            <span class="badge 
                                {{ $order->status_translated === 'completado' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ ucfirst($order->status_translated) }}
                            </span>
                        </p>
                        <p><strong>Nombre del cliente:</strong> {{ $order->customer->name }}</p>
                        <p><strong>Dirección de entrega:</strong> {{ $order->address->address_line_1 .' C/ ' .$order->address->address_line_2 . ', ' . $order->address->city->name}}</p>
                        <p><strong>Email:</strong> {{ $order->customer->email }}</p>
                        <p><strong>Teléfono:</strong> {{ $order->customer->phone }}</p>
                    </div>
                </div>

                <!-- Detalles de los productos -->
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Productos</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($order->items as $item)
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="mb-0">{{ $item->product->name }}</h6>
                                    <small>Cantidad: {{ $item->quantity }}</small>
                                </div>
                                <div class="text-end">
                                    <p class="mb-0">Precio: Gs. {{ \App\Helpers\Helper::formatPrice($item->price) }}</p>
                                    <p class="mb-0">Subtotal: Gs. {{ \App\Helpers\Helper::formatPrice($item->quantity * $item->price) }}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach

                        <!-- Total del pedido -->
                        <div class="text-end mt-3">
                            <h5>Delivery: Gs. {{ \App\Helpers\Helper::formatPrice(\App\Helpers\Helper::getDeliveryCost())}}</h5>
                            <h4>Total: Gs. {{ \App\Helpers\Helper::formatPrice($order->total) }}</h4>
                        </div>
                    </div>
                </div>

                <!-- Botón de continuar comprando -->
                <div class="text-center">
                    <a href="{{ route('products.index') }}" class="btn btn-success btn-lg">Seguir Comprando</a>
                    <a href="{{ route('customer.orders') }}" class="btn btn-warning btn-lg text-white">Ver mis pedidos</a>
                </div>
            </div>
        </div>
    </div>
@endsection
