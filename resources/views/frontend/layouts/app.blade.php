<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="VfE2Exk0Qv-E0UumKlb6y--26JNh4iyUdr6MSG2Ih5o" />
    <meta name="description" content="">
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('meta_title', config('app.name'))" />
    <meta property="og:description" content="@yield('meta_description', 'Explora la mejor selección de productos para electronica y el hogar en Comercial San Rafael.')">
    <title>@yield('meta_title', config('app.name'))</title>
    <link rel="icon" type="image/png" href="/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon/favicon.svg" />
    <link rel="shortcut icon" href="/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png" />
    <link rel="manifest" href="/favicon/site.webmanifest" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    @vite('resources/sass/app.scss')
    @yield('styles')
    <style>
        /* Flexbox para asegurar que el footer quede al final */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Establece el cuerpo con altura mínima de la pantalla */
        }

        main {
            flex-grow: 1; /* Hace que el contenido ocupe el espacio restante */
        }

        footer {
            margin-top: auto; /* Empuja el footer hacia el fondo de la página */
        }
    </style>
</head>

<body>

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{$config['navbar_logo']}}" alt="{{ config('app.name', 'Mi E-commerce') }}" class="img-fluid" style="max-height: 50px;">
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
                                <a class="dropdown-item" href="{{ route('categories.show', $category->slug) }}">
                                    <i class="fas fa-box
                                    "></i> {{ $category->name }}
                                </a>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <form class="d-flex position-relative" action="" method="GET" id="search-form">
                            <input type="text" name="q" class="form-control me-2" placeholder="Buscar..."
                                id="search-input" autocomplete="off">
                            <button class="btn btn-outline-success-custom" type="submit">
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
                    @guest('customer')  
                        @if (Route::has('customer.login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('customer.login') }}">Iniciar sesión</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::guard('customer')->user()->name }}
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('customer.profile') }}">Mis Datos</a>
                                <a class="dropdown-item" href="{{ route('customer.orders') }}">Mis Pedidos</a>
                                <a class="dropdown-item" href="{{ route('customer.change-password') }}">Cambiar Contraseña</a>
                                <a class="dropdown-item" href="{{ route('customer.logout') }}"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a>
                                <form id="logout-form" action="{{ route('customer.logout') }}" method="GET" class="d-none">
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
                        <li><a href="{{ route('info.faq') }}" class="text-black text-decoration-none">Preguntas Frecuentes</a></li>
                        <li><a href="{{ route('info.security-policy') }}" class="text-black text-decoration-none">Política de Privacidad</a></li>
                        <li><a href="{{ route('info.service-terms') }}" class="text-black text-decoration-none">Términos de Servicio</a></li>
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
    @include('components.cart-modal')

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
                var itemQuantity = $('#quantity').val();
                var item = {
                    id: itemId,
                    name: itemName,
                    price: itemPrice,
                    quantity: itemQuantity
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
                    if(data.length === 0){
                        cartItems.append('<li class="list-group-item text-center">No hay productos en el carrito</li>');
                    }
                    data.forEach(function(item) {
                        cartItems.append(`
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <img src="${item.image_url}" alt="${item.name}" class="img-thumbnail" style="width: 50px; height: 50px;">
                                    ${item.name} - Gs. ${item.price}
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
    @yield('scripts')
</body>

</html>
