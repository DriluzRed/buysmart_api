<div class="col-md-6 col-lg-4 mb-4">
    <div class="card product-card h-100 shadow-sm border-0">
        @php
            $imagePath = 'storage/' . $product->main_image;
            $defaultImage = 'path/to/default/image.jpg';
            $discountPercentage = round((($product->price - $product->sale_price) / $product->price) * 100);
        @endphp

        <!-- Imagen principal con destacados -->
        <div class="position-relative">
            <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none">
                <img src="{{ asset(file_exists(public_path($imagePath)) ? $imagePath : $defaultImage) }}"
                     class="card-img-top img-fluid"
                     alt="{{ $product->name }}"
                     style="height: 250px; object-fit: cover;">
                
                @if ($product->is_new)
                    <span class="badge bg-primary-custom position-absolute top-0 start-0 m-2">Nuevo</span>
                @endif

                @if ($product->is_on_sale && $product->sale_price < $product->price)
                    <span class="badge bg-danger position-absolute top-0 end-0 m-2">{{ $discountPercentage }}% OFF</span>
                @endif
            </a>
        </div>

        <!-- Información del producto -->
        <div class="card-body d-flex flex-column">
            <h5 class="card-title text-dark mb-2">{{ $product->name }}</h5>
            <p class="text-muted small mb-2">{{ Str::limit($product->description, 60) }}</p>

            <!-- Disponibilidad -->
            @if (isset($product->stock->quantity) && $product->stock->quantity > 0)
                @if (isset($product->stock->alert_quantity) && $product->stock->quantity <= $product->stock->alert_quantity)
                    <p class="text-danger small mb-1">¡Pocas unidades disponibles!</p>
                @endif
                <p class="text-success fw-bold mb-2">En stock</p>
            @else
                <p class="text-danger fw-bold mb-2">Agotado</p>
            @endif

            <!-- Sección de Precios -->
            <div class="mt-auto">
                @if ($product->is_on_sale && $product->sale_price < $product->price)
                    <p class="text-muted text-decoration-line-through mb-1">Precio: Gs.
                        {{ \App\Helpers\Helper::formatPrice($product->price) }}</p>
                    <h6 class="text-dark fw-bold mb-0">Oferta: Gs.
                        {{ \App\Helpers\Helper::formatPrice($product->sale_price) }}</h6>
                @else
                    <h6 class="text-dark fw-bold mb-0">Gs. {{ \App\Helpers\Helper::formatPrice($product->price) }}</h6>
                @endif
            </div>
        </div>

        <!-- Acciones con botones dinámicos -->
        <div class="card-footer bg-transparent d-flex justify-content-between align-items-center border-top-0">
            @if (isset($product->stock->quantity) && $product->stock->quantity > 0)
                <button class="btn btn-primary btn-sm" data-item-id="{{ $product->id }}"
                    data-item-name="{{ $product->name }}"
                    data-item-price="{{ $product->sale_price }}">
                    <i class="fas fa-cart-plus me-1"></i> Agregar
                </button>
            @else
                <button class="btn btn-secondary btn-sm" disabled>
                    <i class="fas fa-cart-plus me-1"></i> Agotado
                </button>
            @endif
        </div>
    </div>
</div>
