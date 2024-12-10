<div id="relatedProductsCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($relatedProducts->chunk(4) as $index => $productChunk)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="row">
                    @foreach($productChunk as $product)
                        <div class="col-md-3 d-flex">
                            <div class="product-item card flex-grow-1">
                                <div class="card-body d-flex flex-column text-center">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <img src="{{ asset('storage/' . $product->main_image) }}" 
                                         class="img-fluid mb-3" 
                                         alt="{{ $product->name }}">
                
                                    @if($product->is_on_sale)
                                        <p class="h4 text-danger">Gs. {{ \App\Helpers\Helper::formatPrice($product->sale_price) }}</p>
                                        <p class="h5 text-muted text-decoration-line-through">Gs. {{ \App\Helpers\Helper::formatPrice($product->price) }}</p>
                                    @else
                                        <p class="h4 text-dark">Gs. {{ \App\Helpers\Helper::formatPrice($product->price) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
            </div>
        @endforeach
    </div>
    <!-- Carousel controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#relatedProductsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#relatedProductsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
