@extends('frontend.layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <form action="{{ route('products.index') }}" method="GET">
                <div class="row mb-4">
                    <!-- Campo de búsqueda -->
                    <div class="col-md-4 mb-3">
                        <input type="text" name="search" class="form-control form-control-lg" placeholder="Buscar productos"
                            value="{{ request('search') }}">
                    </div>
                    
                    <!-- Categoría -->
                    <div class="col-md-3 mb-3">
                        <select name="category" id="category" class="form-select form-select-lg">
                            <option value="">Seleccionar categoría</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Subcategoría -->
                    <div class="col-md-3 mb-3">
                        <select name="subcategory" id="subcategory" class="form-select form-select-lg">
                            <option value="">Debe seleccionar una categoría</option>
                        </select>
                    </div>
                    
                    <!-- Precio mínimo -->
                    <div class="col-md-2 mb-3">
                        <input type="number" name="min_price" class="form-control form-control-lg" placeholder="Precio mínimo"
                            value="{{ request('min_price') }}">
                    </div>
                    
                    <!-- Precio máximo -->
                    <div class="col-md-2 mb-3">
                        <input type="number" name="max_price" class="form-control form-control-lg" placeholder="Precio máximo"
                            value="{{ request('max_price') }}">
                    </div>
                    
                    <!-- Botón de búsqueda -->
                    <div class="col-md-2 mb-3 d-flex align-items-center">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        
        <div class="row" id="product-container">
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
