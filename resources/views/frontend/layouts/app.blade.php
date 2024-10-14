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
    @section('styles')

    @endsection
</head>
<body>

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Mi E-commerce') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categorías
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($categories as $category)
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>
                                    @if($category->subcategories->isNotEmpty())
                                        <ul class="dropdown-menu">
                                            @foreach($category->subcategories as $subcategory)
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('subcategories.show', $subcategory->slug) }}">{{ $subcategory->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.offers') }}">Ofertas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact.index') }}">Contacto</a>
                    </li>
                </ul>

                <!-- Carrito de compras y sesión del usuario -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            {{-- <i class="bi bi-cart"></i> Carrito ({{ Cart::count() }}) --}}
                        </a>
                    </li>
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
        <div class="container text-center">
            <p class="mb-0">© {{ date('Y') }} {{ config('app.name', 'Mi E-commerce') }}. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies (Popper.js and jQuery if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts personalizados -->
    <script src="{{ asset('js/app.js') }}"></script>
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('.dropdown-submenu a.dropdown-item').on("click", function(e) {
                    var submenu = $(this).next('.dropdown-menu');
                    if(submenu.is(':visible')) {
                        submenu.hide();
                    } else {
                        submenu.show();
                    }
                    e.stopPropagation();
                    e.preventDefault();
                });
            });
        </script>
    @endsection

</body>
</html>
