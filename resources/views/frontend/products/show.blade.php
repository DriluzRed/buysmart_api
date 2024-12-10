@extends('frontend.layouts.app')

@section('meta_title', $product->name . ' - ' . config('app.name'))
@section('meta_description', $product->description)

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Columna de imágenes del producto -->
        <div class="col-md-5">
            <div id="productImageCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($images as $index => $image)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image) }}" 
                                 class="d-block w-100 thumbnail-image" 
                                 data-image-url="{{ asset('storage/' . $image) }}" 
                                 alt="Imagen {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productImageCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productImageCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <!-- Columna de detalles del producto -->
        <div class="col-md-7">
            <h1 class="display-4">{{ $product->name }}</h1>
            @if($product->is_on_sale)
                <p class="text-danger">¡Oferta por tiempo limitado!</p>
                <p class="text-danger">OFERTA SOLO DISPONIBLE POR PAGO EN EFECTIVO O TRANSFERENCIA</p>
                <p class="h4 text-danger">Gs. {{ \App\Helpers\Helper::formatPrice($product->sale_price) }}</p>
                <p class="h5 text-muted text-decoration-line-through">Gs. {{ \App\Helpers\Helper::formatPrice($product->price) }}</p>
            @else
                <p class="h4 text-dark">Gs. {{ \App\Helpers\Helper::formatPrice($product->price) }}</p>
            @endif
            <p class="lead">Detalles del producto:</p>
            <p class="lead">{{ $product->description }}</p>
            @if(isset($product->stock->quantity) && $product->stock->quantity > 0)
                <p class="text-success"><strong>Disponible</strong></p>
                <button class="btn btn-success btn-lg mt-3 add-to-cart" 
                        data-item-id="{{ $product->id }}"
                        data-item-name="{{ $product->name }}" 
                        data-item-price="{{ $product->price }}">
                    Añadir al carrito
                </button>
                <button id="buyNow" class="btn btn-primary btn-lg mt-3">Comprar ahora</button>
            @else
                <p class="text-danger"><strong>Agotado</strong></p>
                <button class="btn btn-secondary btn-lg mt-3" disabled>Añadir al carrito</button>
                <button id="buyNow" class="btn btn-secondary btn-lg mt-3" disabled>Comprar ahora</button>
            @endif
        </div>
    </div>

    <!-- Productos relacionados -->
    <div class="row mt-5">
        <h1 class="text-center">Productos que pueden interesarte</h1>
        <x-related-products />
    </div>
</div>
@endsection
<!-- Scripts -->
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
        // Cambiar la imagen principal al hacer clic en una miniatura

        // Comprar ahora
        $('#buyNow').click(function() {
            const url = '{{ route('checkout.direct', ['id' => $product->id, 'quantity' => ':quantity']) }}';
            window.location.href = url.replace(':quantity', 1);
        });
    });
</script>
@endsection
