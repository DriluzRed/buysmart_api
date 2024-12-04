@extends('frontend.layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <!-- Icono de éxito -->
                <div class="mb-4">
                    <i class="bi bi-check-circle-fill text-primary-custom" style="font-size: 5rem;"></i>
                </div>

                <!-- Mensaje de éxito -->
                <h1 class="display-4 text-dark">¡Pedido realizado con éxito!</h1>
                <p class="lead text-muted">Tu pedido ha sido colocado con éxito. ¡Gracias por comprar con nosotros!</p>

                <!-- Opciones para continuar -->
                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-primary-custom btn-lg">Seguir comprando</a>
                    <a href="{{ route('customer.order.show',[$id]) }}" class="btn btn-outline-success-custom btn-lg">Ver mi pedido</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Puedes añadir scripts adicionales si es necesario -->
@endsection
