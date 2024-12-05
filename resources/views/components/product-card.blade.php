<div class="col-md-4 col-lg-3 mb-4">
    <div class="card product-card h-100 d-flex flex-column shadow-sm">
        @php
            $config = \App\Helpers\Helper::getConfigurations();
            $imagePath = 'storage/' . $product->main_image;
            $defaultImage = 'path/to/default/image.jpg'; // Ruta a la imagen predeterminada
            $number = $config['whatsapp-number'];
        @endphp

        <div class="card h-100">
            <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none">
                @if ($product->is_on_sale)
                    @if ($product->sale_price < $product->price)
                        <span class="badge bg-danger position-absolute top-0 start-0 m-2">OFF</span>
                    @endif
                @endif
                <img src="{{ asset(file_exists(public_path($imagePath)) ? $imagePath : $defaultImage) }}"
                    class="card-img-top img-fluid" alt="{{ $product->name }}" style="object-fit: cover; height: 200px;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-dark mb-2">{{ $product->name }}</h5>
                    <p class="card-text text-muted small mb-3">{{ Str::limit($product->description, 60) }}</p>
                    @if (isset($product->stock->quantity) && $product->stock->quantity > 0)
                        @if (isset($product->stock->alert_quantity) && $product->stock->quantity <= $product->stock->alert_quantity)
                            <p class="text-danger card-text">Solo quedan {{ $product->stock->quantity }} disponibles</p>
                        @endif
                        <p class="card-text text-success fw-bold">Disponible</p>
                    @else
                        <p class="card-text text-danger fw-bold">Agotado</p>
                    @endif
                    @if ($product->is_on_sale)
                        @if ($product->sale_price < $product->price)
                            <div class="mt-auto">
                                <p class="card-text text-decoration-line-through text-muted mb-1">Precio Original: Gs.
                                    {{ \App\Helpers\Helper::formatPrice($product->price) }}</p>
                                <h6 class="card-text text-dark fw-bold">Precio Oferta: Gs.
                                    {{ \App\Helpers\Helper::formatPrice($product->sale_price) }}</h6>
                            </div>
                        @endif
                    @else
                        <h6 class="card-text text-dark fw-bold mt-auto">Gs.
                            {{ \App\Helpers\Helper::formatPrice($product->price) }}</h6>
                    @endif
                </div>
            </a>

            <div class="card-footer bg-light border-top-0 mt-auto">
                @if (isset($product->stock->quantity) && $product->stock->quantity > 0)
                    <button class="btn btn-primary-custom w-100 add-to-cart" data-item-id="{{ $product->id }}"
                        data-item-name="{{ $product->name }}"
                        data-item-price="{{ $product->sale_price < $product->price ? $product->sale_price : $product->price }}">
                        <i class="fas fa-cart-plus me-1"></i> Agregar al carrito
                    </button>
                    @if (env('PLAN') == 'basic')
                        <a href="https://wa.me/{{ $number }}?text={{ urlencode('Hola, me gustaría consultar sobre el producto: ' . $product->name . ' Este es el producto ' . route('products.show', $product->slug)) }}"
                            target="_blank" class="btn btn-success w-100 mt-2 text-white">
                            <i class="fa-brands fa-whatsapp"></i> Consultar al Whatsapp
                        </a>
                    @endif
                @else
                    <button class="btn btn-secondary w-100" disabled>
                        <i class="fas fa-cart-plus me-1"></i> Agregar al carrito
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
