@extends('frontend.layouts.app')
@section('meta_title', 'Categorias' . ' - ' . config('app.name'))
@section('meta_description', 'Lista de todas las categorías disponibles en la tienda')
@section('content')
    <div class="container">
        <div class="row">
                
                <!-- Formulario de búsqueda -->
                <form action="{{ route('categories.show', $category->slug) }}" method="GET" class="mb-5">
                    <div class="row g-3 align-items-center">
                        <!-- Campo de búsqueda -->
                        <div class="col-md-3">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Buscar productos" value="{{ request('search') }}">
                        </div>
                
                        <!-- Subcategoría -->
                        <div class="col-md-3">
                            <select name="subcategory" id="subcategory" class="form-select">
                                <option value="">Mostrar todos</option>
                                @foreach($category->subcategories as $subcategory)
                                    <option value="{{ $subcategory->slug }}" {{ request('subcategory') == $subcategory->slug ? 'selected' : '' }}>
                                        {{ $subcategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                
                        <!-- Rango de precio -->
                        <div class="col-md-2">

                            <input type="number" name="min_price" id="min_price" class="form-control" placeholder="Precio mínimo" value="{{ request('min_price') }}">
                        </div>
                        <div class="col-md-2">
              
                            <input type="number" name="max_price" id="max_price" class="form-control" placeholder="Precio máximo" value="{{ request('max_price') }}">
                        </div>
                
                        <!-- Opciones adicionales -->
                        <div class="col-md-1">
                            <div class="form-check">
                                <input type="checkbox" name="is_new" class="form-check-input" id="is_new" {{ request('is_new') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_new">Nuevo</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-check">
                                <input type="checkbox" name="on_sale" class="form-check-input" id="on_sale" {{ request('on_sale') ? 'checked' : '' }}>
                                <label class="form-check-label" for="on_sale">En oferta</label>
                            </div>
                        </div>
                
                        <!-- Botón de búsqueda -->
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary-custom">Buscar</button>
                        </div>
                    </div>
                </form>
                
                <div class="row">
                    @if($products->isEmpty())
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                No se encontraron productos
                            </div>
                        </div>
                    @endif
                    @foreach($products as $product)
                        @include('components.product-card', ['product' => $product])
                    @endforeach
                </div>

        </div>
        <div class="d-flex justify-content-center mt-5">
            {{ $products->links() }}
        </div>
    </div>
@endsection