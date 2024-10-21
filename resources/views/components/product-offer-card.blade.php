<div class="col-md-4 col-lg-3 mb-4">
    <div class="card product-card h-100 d-flex flex-column">
        @php
            $imagePath = 'storage/' . $product->main_image;
            $defaultImage = 'path/to/default/image.jpg'; // Ruta a la imagen predeterminada
        @endphp

        <a href="{{ route('products.show', $product->slug) }}" class="stretched-link text-decoration-none flex-grow-1">
            @php
                $discountPercentage = round((($product->price - $product->sale_price) / $product->price) * 100);
            @endphp
            <h3>
                <span class="badge bg-success">{{ $discountPercentage }}% OFF</span>
            </h3>
            <img src="{{ asset(file_exists(public_path($imagePath)) ? $imagePath : $defaultImage) }}" class="card-img-top"
                alt="{{ $product->name }}">
            <div class="card-body">
                <h5 class="card-title text-dark">{{ $product->name }}</h5>
                <p class="card-text text-dark">{{ $product->description }}</p>
                @if ($product->stock->quantity > 0)
                    <p class="card-text text-success">Disponible</p>
                @else
                    <p class="card-text text-danger">Agotado</p>
                @endif
                <p class="card-text text-dark">Precio Original: ${{ $product->price }}</p>
                <p class="card-text text-dark">Precio de Oferta: ${{ $product->sale_price }}</p>

            </div>
        </a>
        <div class="card-footer bg-transparent border-0 mt-auto">
            @if ($product->stock->quantity > 0)
                <button class="btn btn-primary add-to-cart" data-item-id="{{ $product->id }}"
                    data-item-name="{{ $product->name }}" data-item-price="{{ $product->sale_price }}">
                    <i class="fas fa-cart-plus"></i> Agregar al carrito
                </button>
            @else
                <button class="btn btn-secondary" disabled>
                    <i class="fas fa-cart-plus"></i> Agregar al carrito
                </button>
            @endif
        </div>
    </div>
</div>
