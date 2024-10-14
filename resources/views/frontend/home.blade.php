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
                        <img src="{{ $offer->image_url }}" class="card-img-top" alt="{{ $offer->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $offer->name }}</h5>
                            <p class="card-text">{{ $offer->description }}</p>
                            <p><strong>Precio en oferta: ${{ $offer->sale_price }}</strong></p>
                            <p><small>Precio normal: <del>${{ $offer->regular_price }}</del></small></p>
                            <a href="{{ route('products.show', $offer->slug) }}" class="btn btn-primary">Ver producto</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">No hay ofertas disponibles en este momento.</p>
        @endif
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $offers->links() }}
    </div>
</div>

@endsection
