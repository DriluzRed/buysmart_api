@extends('frontend.layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="text-center mb-5">
            <h2 class="display-4">Preguntas Frecuentes</h2>
            <p>Encuentra respuestas a las preguntas más comunes.</p>
        </div>

        <div id="accordion">
            @foreach ($faqs as $index => $faq)
                <div class="card mb-3 border-0 shadow-sm">
                    <div class="card-header bg-primary-custom text-white" id="heading{{ $index }}">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-white" data-toggle="collapse" data-target="#collapse{{ $index }}" 
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                {{ $faq->question }}
                            </button>
                        </h5>
                    </div>

                    <div id="collapse{{ $index }}" class="collapse {{ $index === 0 ? 'show' : '' }}" 
                        aria-labelledby="heading{{ $index }}" data-parent="#accordion">
                        <div class="card-body text-dark">
                            {{ $faq->answer }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Asegúrate de incluir los scripts necesarios si estás usando Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
@endsection
