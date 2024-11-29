@extends('frontend.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mb-5">
                    <!-- Título de la categoría -->
                    <div class="col-md-12 text-center">
                        <h1 class="display-4">{{ $category->name }}</h1>
                    </div>
                </div>
        
                <!-- Formulario de búsqueda -->
                <form action="{{ route('categories.show', $category->slug) }}" method="GET" class="mb-5">
                    <div class="row align-items-center">
                        <!-- Campo de búsqueda -->
                        <div class="col-md-3 mb-3">
                            <input type="text" name="search" class="form-control form-control-lg" placeholder="Buscar productos" value="{{ request('search') }}">
                        </div>
        
                        <!-- Subcategoría -->
                        <div class="col-md-3 mb-3">
                            <select name="subcategory" class="form-select form-select-lg">
                                <option value="">Mostrar todos</option>
                                @foreach($category->subcategories as $subcategory)
                                    <option value="{{ $subcategory->slug }}" {{ request('subcategory') == $subcategory->slug ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
        
                        <!-- Rango de precio -->
                        <div class="col-md-2 mb-3">
                            <input type="number" name="min_price" class="form-control form-control-lg" placeholder="Precio mínimo" value="{{ request('min_price') }}">
                        </div>
                        <div class="col-md-2 mb-3">
                            <input type="number" name="max_price" class="form-control form-control-lg" placeholder="Precio máximo" value="{{ request('max_price') }}">
                        </div>
                        <!-- Checkbox de nuevo -->
                        <div class="col-md-1 mb-3 form-check">
                            <input type="checkbox" name="is_new" class="form-check-input" id="is_new" {{ request('is_new') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_new">Nuevo</label>
                        </div>

                        <!-- Checkbox de oferta -->
                        <div class="col-md-1 mb-3 form-check">
                            <input type="checkbox" name="on_sale" class="form-check-input" id="on_sale" {{ request('on_sale') ? 'checked' : '' }}>
                            <label class="form-check-label" for="on_sale">En oferta</label>
                        </div>
        
                        <!-- Botón de búsqueda -->
                        <div class="col-md-2 mb-3">
                            <button type="submit" class="btn btn-primary btn-lg w-100">Buscar</button>
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
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{ $products->links() }}
        </div>
    </div>
@endsection