@extends('frontend.layouts.app')
@section('meta_title', 'Productos' . ' - ' . config('app.name'))
@section('meta_description', 'Lista de todos los productos disponibles en la tienda')
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('products.index') }}" method="GET">
                <!-- Campo de búsqueda -->
                <div class="row mb-3 align-items-center">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Buscar productos" value="{{ request('search') }}">
                    </div>
                </div>
        
                <!-- Filtros -->
                <div class="row mb-3">
                    <!-- Categoría -->
                    <div class="col-md-3">
                        <select name="category" id="category" class="form-select">
                            <option value="">Seleccionar categoría</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
        
                    <!-- Subcategoría -->
                    <div class="col-md-3">
                        <select name="subcategory" id="subcategory" class="form-select">
                            <option value="">Debe seleccionar una categoría</option>
                        </select>
                    </div>
        
                    <!-- Precio mínimo -->
                    <div class="col-md-2">
                        <input type="number" name="min_price" id="min_price" class="form-control" placeholder="Precio mínimo" value="{{ request('min_price') }}">
                    </div>
        
                    <!-- Precio máximo -->
                    <div class="col-md-2">
                        <input type="number" name="max_price" id="max_price" class="form-control" placeholder="Precio máximo" value="{{ request('max_price') }}">
                    </div>
                </div>
        
                <!-- Opciones adicionales -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <div class="form-check">
                            <input type="checkbox" name="is_new" class="form-check-input" id="is_new" {{ request('is_new') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_new">Nuevo</label>
                        </div>
                    </div>
        
                    <div class="col-md-2">
                        <div class="form-check">
                            <input type="checkbox" name="on_sale" class="form-check-input" id="on_sale" {{ request('on_sale') ? 'checked' : '' }}>
                            <label class="form-check-label" for="on_sale">En oferta</label>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary-custom w-100">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        

        <div class="row mt-4 border" id="product-container">
            @if ($products->isNotEmpty())
                @foreach ($products as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            @else
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        No se encontraron productos
                    </div>
                </div>
            @endif
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-5">
            {{ $products->links() }}
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#category').change(function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '{{ route('get-subcategories') }}',
                        type: 'GET',
                        data: {
                            category_id: categoryId
                        },
                        success: function(data) {
                            $('#subcategory').empty();
                            $('#subcategory').append(
                                '<option value="">Seleccionar Todos</option>');
                            $.each(data, function(key, value) {
                                $('#subcategory').append('<option value="' + key +
                                    '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#subcategory').empty();
                    $('#subcategory').append('<option value="">Debe seleccionar una categoría</option>');
                }
            });

            // Cargar subcategorías si hay una categoría seleccionada
            var selectedCategory = $('#category').val();
            if (selectedCategory) {
                $.ajax({
                    url: '{{ route('get-subcategories') }}',
                    type: 'GET',
                    data: {
                        category_id: selectedCategory
                    },
                    success: function(data) {
                        $('#subcategory').empty();
                        $('#subcategory').append(
                            '<option value="">Debe seleccionar una categoría</option>');
                        $.each(data, function(key, value) {
                            $('#subcategory').append('<option value="' + key + '" ' + (key ==
                                    '{{ request('subcategory') }}' ? 'selected' : '') +
                                '>' + value + '</option>');
                        });
                    }
                });
            }
        });
    </script>
@endsection
