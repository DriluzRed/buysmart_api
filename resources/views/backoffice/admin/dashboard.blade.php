{{-- resources/views/vendor/backpack/dashboard.blade.php --}}
@extends(backpack_view('blank'))
@section('before_styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    @vite('resources/sass/app.scss')
@endsection
@section('header')
    <section class="content-header">
        <h1>Dashboard</h1>
    </section>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title">Total de Clientes</h5>
                        <h2 class="card-text">{{ $data['total_customers'] }}</h2>
                        <p class="card-text"><small>Últimos 30 días</small></p>
                    </div>
                </div>
            </div>
            <!-- Ingresos -->
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title">Ingresos</h5>
                        <h2 class="card-text">Gs. {{ \App\Helpers\Helper::formatPrice($data['total_sales']) }}</h2>
                        <p class="card-text"><small>Últimos 30 días</small></p>
                    </div>
                </div>
            </div>
            <!-- Pedidos -->
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title">Pedidos Entregados</h5>
                        <h2 class="card-text">{{ $data['total_finished_orders'] }}</h2>
                        <p class="card-text"><small>Últimos 30 días</small></p>
                    </div>
                </div>
            </div>
            <!-- Usuarios -->
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title">Pedidos Pendientes</h5>
                        <h2 class="card-text">{{ $data['total_pending_orders'] }}</h2>
                        <p class="card-text"><small>Últimos 30 días</small></p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="">
                <h4>Filtrar por rango de fechas</h4>
                <form id="filterForm" action="{{ route('backpack.dashboard') }}">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="date" name="desde" id="desde" class="form-control" required value="{{request('desde')}}">
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="hasta" id="hasta" class="form-control" required value="{{request('hasta')}}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title">Total de Clientes</h5>
                        <h2 class="card-text">{{ $filteredData['total_customers'] }}</h2>
                    </div>
                </div>
            </div>
            <!-- Ingresos -->
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title">Ingresos</h5>
                        <h2 class="card-text">Gs. {{ \App\Helpers\Helper::formatPrice($filteredData['total_sales']) }}</h2>
                    </div>
                </div>
            </div>
            <!-- Pedidos -->
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title">Pedidos Entregados</h5>
                        <h2 class="card-text">{{ $filteredData['total_finished_orders'] }}</h2>
                    </div>
                </div>
            </div>
            <!-- Usuarios -->
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title">Pedidos Pendientes</h5>
                        <h2 class="card-text">{{ $filteredData['total_pending_orders'] }}</h2>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
@section('after_scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
