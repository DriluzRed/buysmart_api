@extends('frontend.layouts.app')

@section('content')

<!-- Offers Section -->

<div class="container-fluid mt-5">
    <div class="d-block d-lg-none w-100 mt-4 mb-4">
        <form class="d-flex justify-content-center align-items-center w-100" action="" method="GET"
            id="search-form-mobile">
            <input type="text" name="q" class="form-control me-2" placeholder="Buscar..."
                id="search-input-mobile" autocomplete="off" style="">
            <button class="btn btn-outline-success-custom" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <div class="dropdown-menu" id="search-results-mobile"
                style="display: none; position:absolute; left: 0; right:0; top:20%; width: 100%;"></div>
        </form>
    </div>
    <x-slider />
</div>
<div class="container mt-5">
    
    <h2 class="text-center">Productos en Oferta</h2>
    <div class="row">
        @if($offers->isNotEmpty())
        <div class="row">
            @foreach($offers as $offer)
                @include('components.product-offer-card', ['product' => $offer])
            @endforeach
        </div>

        @else
            <p class="text-center">No hay ofertas disponibles en este momento.</p>
        @endif
    </div>
    <h2 class="text-center">Recién llegados</h2>
    <div class="row">
        @if($products->isNotEmpty())
        <div class="row">
            @foreach($products as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
        @else
            <p class="text-center">No hay productos disponibles en este momento.</p>
        @endif
    </div>
    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        <a href="{{route('products.index')}}" class="btn btn-primary-custom text-white">Ver todos los productos</a>
    </div>
</div>

@endsection
