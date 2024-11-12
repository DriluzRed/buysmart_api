@if($products->isEmpty())
    <div class="dropdown-item">No se encontraron productos.</div>
@else
    @foreach($products as $product)
    <div class="d-flex align-items-center">
        <img src="{{asset('storage/' . $product->main_image)}}" alt="Parlante Satellite AS-2301" class="img-fluid" style="width: 50px;">
        <div class="ms-3">
            <h6 class="mb-1"><a href="{{ route('products.show', $product->slug) }}" class="dropdown-item">{{ $product->name }}</a></h6>
            <p class="mb-0 text-muted">Gs. {{\App\Helpers\Helper::formatPrice($product->price)}}</p>
        </div>
    </div>
    @endforeach
@endif