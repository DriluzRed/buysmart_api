@extends('frontend.layouts.app')

@section('meta_title', $product->name . ' - ' . config('app.name'))
@section('meta_description', $product->description)

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Imagen del producto -->
            <div class="col-md-6">
                <h1 class="display-5 fw-bold text-primary mb-4">{{ $product->name }}</h1>
                <div id="productImageCarousel" class="carousel slide shadow rounded overflow-hidden" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image) }}" class="d-block w-100" alt="Imagen {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productImageCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productImageCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>

            <!-- Detalles del producto -->
            <div class="col-md-6">
                <div class="product-details">
                    @if (isset($product->stock->quantity) && $product->stock->quantity > 0)
                        <p class="text-success fw-bold fs-5">Disponible</p>
                        <button class="btn btn-success btn-lg mt-3 me-2 add-to-cart" data-item-id="{{ $product->id }}" data-item-name="{{ $product->name }}" data-item-price="{{ $product->price }}">
                            <i class="bi bi-cart-plus"></i> Añadir al carrito
                        </button>
                        <button id="buyNow" class="btn btn-primary btn-lg mt-3">
                            <i class="bi bi-bag-check"></i> Comprar ahora
                        </button>
                    @else
                        <p class="text-danger fw-bold fs-5">Agotado</p>
                        <button class="btn btn-secondary btn-lg mt-3 me-2" disabled>
                            <i class="bi bi-cart-x"></i> Añadir al carrito
                        </button>
                        <button id="buyNow" class="btn btn-secondary btn-lg mt-3" disabled>
                            <i class="bi bi-bag-x"></i> Comprar ahora
                        </button>
                    @endif
                    <p class="h3 text-dark mt-4">Gs. {{ \App\Helpers\Helper::formatPrice($product->price) }}</p>
                    <div class="row mt-5">
                        <div class="col-12">
                            <h4 class="fw-bold">Detalles del producto</h4>
                            <p class="lead">{!! nl2br(e($product->description)) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Descripción del producto -->
       
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Cambiar la imagen principal al hacer click en una miniatura
            $('.thumbnail-image').click(function() {
                var newImageUrl = $(this).data('image-url');
                $('#mainImage').attr('src', newImageUrl);
            });

            // Función para "Comprar ahora"
            $('#buyNow').click(function() {
                var url = '{{ route('checkout.direct', ['id' => $product->id, 'quantity' => ':quantity']) }}';
                url = url.replace(':quantity', 1); // Se utiliza cantidad 1 por defecto
                window.location.href = url;
            });
        });
    </script>
@endsection