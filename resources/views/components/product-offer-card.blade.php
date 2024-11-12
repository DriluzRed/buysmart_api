<div class="col-md-4 col-lg-3 mb-4">
    <div class="card product-card h-100 d-flex flex-column shadow-sm">
        @php
            $imagePath = 'storage/' . $product->main_image;
            $defaultImage = 'path/to/default/image.jpg';
            $discountPercentage = round((($product->price - $product->sale_price) / $product->price) * 100);
        @endphp

        <a href="{{ route('products.show', $product->slug) }}" class="stretched-link text-decoration-none flex-grow-1">
            @if($product->is_new)
            <span class="badge bg-primary position-absolute m-2 p-2">Nuevo</span>
            @endif
            @if($product->is_on_sale)
                @if($product->is_new)
                    <span class="badge bg-primary position-absolute m-2 p-2">Nuevo</span>
                @endif
                @if($product->sale_price < $product->price)
                    @php
                        $discountPercentage = round((($product->price - $product->sale_price) / $product->price) * 100);
                    @endphp
                    <span class="badge bg-warning position-absolute m-2 p-2" style="right: 0;">{{ $discountPercentage }}% OFF</span>
                @endif
            @endif
            <img src="{{ asset(file_exists(public_path($imagePath)) ? $imagePath : $defaultImage) }}" class="card-img-top img-fluid" alt="{{ $product->name }}" style="object-fit: cover; height: 200px;">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title text-dark mb-2">{{ $product->name }}</h5>
                <p class="card-text text-muted small mb-3">{{ Str::limit($product->description, 60) }}</p>
                
                @if(isset($product->stock->quantity) && $product->stock->quantity > 0)
                    <p class="card-text text-success fw-bold">Disponible</p>
                @else
                    <p class="card-text text-danger fw-bold">Agotado</p>
                @endif

                <div class="mt-auto">
                    <p class="card-text text-decoration-line-through text-muted mb-1">Precio Original: Gs. {{ \App\Helpers\Helper::formatPrice($product->price) }}</p>
                    <h6 class="card-text text-dark fw-bold">Precio Oferta: Gs. {{ \App\Helpers\Helper::formatPrice($product->sale_price) }}</h6>
                </div>
            </div>
        </a>

        <div class="card-footer bg-light border-top-0 mt-auto">
            @if (isset($product->stock->quantity) && $product->stock->quantity > 0)
                <button class="btn btn-primary w-100 add-to-cart" data-item-id="{{ $product->id }}"
                    data-item-name="{{ $product->name }}" data-item-price="{{ $product->sale_price }}">
                    <i class="fas fa-cart-plus me-1"></i> Agregar al carrito
                </button>
            @else
                <button class="btn btn-secondary w-100" disabled>
                    <i class="fas fa-cart-plus me-1"></i> Agregar al carrito
                </button>
            @endif
        </div>
    </div>
</div>
