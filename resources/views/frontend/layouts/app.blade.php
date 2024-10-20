<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BuySmart') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    @section('styles')
    @endsection
</head>

<body>

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-store"></i> {{ config('app.name', 'Mi E-commerce') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}"><i class="fas fa-home"></i> Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-th-list"></i> Categorías
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('products.index') }}"><i class="fas fa-boxes"></i> Todos los productos</a>
                            <hr>
                            @foreach ($categories as $category)
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#" id="submenu-{{ $category->id }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-tag"></i> {{ $category->name }}
                                    </a>
                                    @if ($category->subcategories->isNotEmpty())
                                        <ul class="dropdown-menu" aria-labelledby="submenu-{{ $category->id }}">
                                            @foreach ($category->subcategories as $subcategory)
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('subcategories.show', $subcategory->slug) }}"><i class="fas fa-tags"></i> {{ $subcategory->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <form class="d-flex position-relative" action="" method="GET" id="search-form">
                            <input type="text" name="q" class="form-control me-2" placeholder="Buscar..."
                                id="search-input" autocomplete="off">
                            <button class="btn btn-outline-success" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <div class="dropdown-menu" id="search-results"
                                style="display: none; position: absolute; top: 100%; left: 0; width: 100%;"></div>
                        </form>
                    </li>
                </ul>

                <!-- Carrito de compras y sesión del usuario -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <button class="btn" onclick="openCart()">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span id="cart-count" class="badge bg-secondary">0</span>
                        </button>
                    </li>
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center text-md-left">
                    <h5>{{ config('app.name', 'Mi E-commerce') }}</h5>
                    <p>© {{ date('Y') }} Todos los derechos reservados.</p>
                </div>
                <div class="col-md-4 text-center">
                    <h5>Enlaces útiles</h5>
                    <ul class="list-unstyled">
                        {{-- <li><a href="{{ route('info.security-policy') }}">Política de Privacidad</a></li>
                        <li><a href="{{ route('info.service-terms') }}">Términos de Servicio</a></li>
                        <li><a href="{{ route('info.contact') }}">Contacto</a></li> --}}
                    </ul>
                </div>
                <div class="col-md-4 text-center text-md-right">
                    <h5>Síguenos</h5>
                    <a href="https://www.facebook.com" class="text-dark mr-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.twitter.com" class="text-dark mr-2"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com" class="text-dark"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal del carrito -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Carrito de Compras</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="cart-items" class="list-group">
                        <!-- Los elementos del carrito se agregarán aquí dinámicamente -->
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <a href="{{ route('checkout') }}" class="btn btn-primary">Proceder al pago</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (Popper.js and jQuery if needed) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts personalizados -->
    @vite(['resources/js/app.js'])
    <script>
        $(document).ready(function() {
            updateCartCount();
            flatpickr('.datepicker', {
                enableTime: true,
                dateFormat: 'Y-m-d H:i',
            });
            

            $('.dropdown-submenu > a').on('click', function(event) {
                event.preventDefault();
                var $parent = $(this).parent();
                $parent.toggleClass('show');
                $parent.find('.dropdown-menu').first().toggle();
            });

            $('#search-input').on('keyup', function() {
                var query = $(this).val();
                if (query.length > 2) {
                    $.ajax({
                        url: '{{ route('products.search') }}',
                        method: 'GET',
                        data: {
                            q: query
                        },
                        success: function(data) {
                            $('#search-results').html(data);
                            $('#search-results').show();
                        }
                    });
                } else {
                    $('#search-results').hide();
                }
            });
            $('.add-to-cart').on('click', function() {
                var itemId = $(this).data('item-id');
                var itemName = $(this).data('item-name');
                var itemPrice = $(this).data('item-price');

                var item = {
                    id: itemId,
                    name: itemName,
                    price: itemPrice
                };

                $.ajax({
                    url: '/cart/add',
                    method: 'POST',
                    data: {
                        item: item,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log(data);

                        if (data.success) {
                            updateCartCount();
                            Swal.fire({
                                icon: 'success',
                                title: 'Producto agregado',
                                text: 'El producto ha sido agregado al carrito.',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        }
                        else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                        }
                    }
                });
            });
        });

        window.openCart = function() {
            $.ajax({
                url: '/cart',
                method: 'GET',
                success: function(data) {
                    var cartItems = $('#cart-items');
                    cartItems.empty();
                    data.forEach(function(item) {
                        cartItems.append(`
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <img src="${item.image_url}" alt="${item.name}" class="img-thumbnail" style="width: 50px; height: 50px;">
                                    ${item.name} - $${item.price}
                                    <div class="input-group mt-2">
                                        <button class="btn btn-outline-secondary btn-decrement" data-item-id="${item.id}">-</button>
                                        <input type="text" class="form-control text-center" value="${item.quantity}" readonly>
                                        <button class="btn btn-outline-secondary btn-increment" data-item-id="${item.id}">+</button>
                                    </div>
                                </div>
                                <button class="btn btn-danger btn-remove" data-item-id="${item.id}">&times;</button>
                            </li>
                        `);
                    });
                    $('#cartModal').modal('show');
                }
            });
        }

        $(document).on('click', '.btn-increment', function() {
            var itemId = $(this).data('item-id');
            updateCartItem(itemId, 1);
        });

        $(document).on('click', '.btn-decrement', function() {
            var itemId = $(this).data('item-id');
            updateCartItem(itemId, -1);
        });

        $(document).on('click', '.btn-remove', function() {
            var itemId = $(this).data('item-id');
            removeCartItem(itemId);
        });

        function updateCartItem(itemId, quantityChange) {
            $.ajax({
                url: '/cart/update',
                method: 'POST',
                data: {
                    item_id: itemId,
                    quantity_change: quantityChange,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    if(data.success){
                        openCart();
                        updateCartCount();
                    }
                    else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                    openCart();
                }
            });
        }

        function removeCartItem(itemId) {
            $.ajax({
                url: '/cart/remove',
                method: 'POST',
                data: {
                    item_id: itemId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    openCart();
                    Swal.fire({
                        icon: 'success',
                        title: '¡Producto eliminado del carrito!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    if (data.length === 0) {
                        $('#cartModal').modal('hide');
                    }
                    updateCartCount();
                }
            });
        }

        function updateCartCount() {
            $.ajax({
                url: '/cart',
                method: 'GET',
                success: function(data) {
                    $('#cart-count').text(data.length);
                }
            });
        }
    </script>
    @section('scripts')
    @endsection

</body>

</html>
