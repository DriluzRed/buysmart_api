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
            <div class="card-header">
                <h4>Reportes</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                                <tr>
                                    <td>{{ $report->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="submitReportForm({{ $report->id }})">Descargar en Excel</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $reports->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection
@section('after_scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function submitReportForm(reportId) {
            var form = document.createElement('form');
            form.action = "{{ route('report.download') }}";
            form.method = 'POST';
            form.id = 'reportForm';
            form.style.display = 'none';
            var report_id = document.createElement('input');
            report_id.name = 'report_id';
            report_id.value = reportId;
            var desde = document.createElement('input');
            desde.name = 'desde';
            desde.value = document.getElementById('desde').value;
            var hasta = document.createElement('input');
            hasta.name = 'hasta';
            hasta.value = document.getElementById('hasta').value;
            form.appendChild(report_id);
            form.appendChild(desde);
            form.appendChild(hasta);
            document.body.appendChild(form);
            var token = document.createElement('input');
            token.name = '_token';
            token.value = "{{ csrf_token() }}";
            token.type = 'hidden';
            form.appendChild(token);
            form.submit();
        }
    </script>
@endsection
