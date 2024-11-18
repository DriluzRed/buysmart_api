@extends(backpack_view('blank'))

@section('before_styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    @vite('resources/sass/app.scss')
@endsection

@section('header')
    <section class="content-header">
        <h1>Reportes</h1>
    </section>
@endsection

@section('content')
    <div class="container mt-5">
        <form id="report-form" action="{{ route('report.download') }}" method="POST" onsubmit="handleFormSubmit(event)">
            @csrf
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="start_date">Fecha de Inicio</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="end_date">Fecha de Fin</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                </div>
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
            <input type="hidden" name="report_id" id="report_id">
        </form>
    </div>
    <div id="loadingOverlay" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Cargando...</span>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function submitReportForm(reportId) {
            document.getElementById('report_id').value = reportId;
            document.getElementById('report-form').submit();
        }

        function handleFormSubmit(event) {
            event.preventDefault();
            document.getElementById('loadingOverlay').style.display = 'block';
            event.target.submit();
        }

        $(document).ready(function() {
            // Inicializar el dropdown de Bootstrap
            $('.dropdown-toggle').dropdown();
        });
    </script>
@endsection