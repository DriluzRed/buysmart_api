@extends('frontend.layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="text-center mb-5">
            <h1>Checkout</h1>
            <p class="text-muted">Revisa y completa la información para finalizar tu compra</p>
        </div>

        <div class="row">
            <!-- Formulario de Envío y Pago -->
            <div class="col-md-8">

                <form id="checkout-form">
                    @csrf
                    <input type="hidden" name="type" value="direct">
                    <input type="hidden" name="total" value="{{ $total }}">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="card shadow-sm p-4 mb-4">
                        <h3 class="card-title">Información de Envío</h3>
                        <hr>
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Dirección</label>
                            <select class="form-control" id="address" name="address" required>
                                <option value="" disabled selected>Seleccione su dirección de envío</option>
                                @foreach (\App\Helpers\Helper::getAddresses() as $address)
                                    <option value="{{ $address->id }}">
                                        {{ $address->address_line_1 }}, {{ $address->department->name }},
                                        {{ $address->city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Información de Pago -->
                    <div class="card shadow-sm p-4">
                        <h3 class="card-title">Información de Pago</h3>
                        <hr>
                        <div class="form-group mb-3">
                            <label for="payment_type" class="form-label">Forma de pago</label>
                            <select class="form-control" id="payment_method" name="payment_method" required>
                                <option value="" disabled selected>Seleccione su forma de pago</option>
                                @foreach (\App\Helpers\Helper::getPaymentMethods() as $payment_method)
                                    <option value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Botón de Procesar Pago -->
                    <div class="text-end mt-4">
                        @if (env('PLAN') == 'basic')
                        <button type="submit" class="btn btn-primary-custom btn-lg">
                            <i class="fa-brands fa-whatsapp"></i> Generar orden y enviar por WhatsApp
                        </button>
                        @else
                            <button type="submit" class="btn btn-primary-custom btn-lg">
                                Procesar Pago
                            </button>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Resumen del Pedido -->
            <div class="col-md-4">
                <div class="card shadow-sm p-3">
                    <h3 class="card-title">Resumen del Pedido</h3>
                    <hr>
                    <p><strong>Producto:</strong> {{ $product->name }}</p>
                    <p><strong>Cantidad:</strong> {{ $quantity }}</p>
                    <p><strong>Precio:</strong> Gs. {{ \App\Helpers\Helper::formatPrice($price) }}</p>
                    <p><strong>Delivery:</strong> Gs. {{ \App\Helpers\Helper::formatPrice(\App\Helpers\Helper::getDeliveryCost())}}</p>
                    <hr>
                    <h5>Total: <strong>Gs. {{ \App\Helpers\Helper::formatPrice($total) }}</strong>
                    </h5>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#checkout-form').on('submit', function(event) {
                event.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('checkout.process') }}',
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Pedido realizado con éxito!',
                                text: 'Tu pedido ha sido colocado con éxito. ¡Gracias por comprar con nosotros!'
                            }).then(function() {
                                if(data.type === 'whatsapp') {
                                    window.open(data.redirect_url, '_blank');
                                    window.location.href = '{{ route('products.index') }}';
                                }
                                else {
                                    window.location.href = data.redirect_url;
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un error al procesar el pedido. Por favor, intente de nuevo.'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un error al procesar el pedido. Por favor, intente de nuevo.'
                        });
                    }
                });
            });
        });
    </script>
@endsection