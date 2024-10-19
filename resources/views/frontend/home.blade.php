@extends('frontend.layouts.app')

@section('content')

<!-- Offers Section -->
<div class="container mt-5">
    @include('components.slider', ['sliders' => $products_banners])
    <h2 class="text-center">Ofertas destacadas</h2>
    <div class="row">
        @if($offers->isNotEmpty())
            @foreach($offers as $offer)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $offer->main_image }}" class="card-img-top" alt="{{ $offer->name }} ">
                        <div class="card-body">
                            <h5 class="card-title">{{ $offer->name }}</h5>
                            <p class="card-text">{{ $offer->description }}</p>
                            <p><strong>Precio en oferta: {{ \App\Helpers\Helper::formatPrice($offer->sale_price) }}</strong></p>
                            <p><small>Precio normal: {{ \App\Helpers\Helper::formatPrice($offer->price) }}</></small></p>
                            <a href="{{ route('products.show', $offer->slug) }}" class="btn btn-primary">Ver producto</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">No hay ofertas disponibles en este momento.</p>
        @endif
    </div>
    <h2 class="text-center">Nuestros Productos</h2>
    <div class="row">
        @if($products->isNotEmpty())
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $product->main_image }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title
                            ">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p><strong>Precio: {{ \App\Helpers\Helper::formatPrice($product->price) }}</strong></p>
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary">Ver producto</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">No hay productos disponibles en este momento.</p>
        @endif
    </div>
    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        <a href="{{route('products.index')}}"> Ver mas</a>
    </div>
</div>

@endsection
