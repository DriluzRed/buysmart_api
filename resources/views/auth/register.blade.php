@extends('frontend.layouts.customer')

@section('content')
<section class="vh-100" style="background-color: #f4f5f7;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="card shadow-lg" style="border-radius: 15px;">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <img src="/img/logo.png" alt="Logo" class="img-fluid mb-3" style="max-width: 150px;">
                            <h3 class="mb-3 fw-bold text-primary">Crear Cuenta</h3>
                        </div>
                        <form method="POST" action="{{ route('customer.register') }}">
                            @csrf
                            <div class="row">
                                <!-- CI -->
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input type="text" id="ci" name="ci" class="form-control @error('ci') is-invalid @enderror" placeholder="Cédula de Identidad" value="{{ old('ci') }}" required>
                                        <label for="ci">Cédula de Identidad</label>
                                        @error('ci')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Name -->
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre" value="{{ old('name') }}" required>
                                        <label for="name">Nombre</label>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Birthdate -->
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input type="date" id="birthdate" name="birthdate" class="form-control  datepicker @error('birthdate') is-invalid @enderror" placeholder="Fecha de Nacimiento" value="{{ old('birthdate') }}" required>
                                        <label for="birthdate">Fecha de Nacimiento</label>
                                        @error('birthdate')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required>
                                        <label for="email">Correo Electrónico</label>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-md-12 mb-3">
                                    <label for="phone" class="form-label">Teléfono</label>
                                    <div class="input-group">
                                        <select name="prefix" id="prefix" class="form-select" style="max-width: 100px;">
                                            @foreach (\App\Helpers\Helper::phonePrefixes() as $prefix)
                                                <option value="{{ $prefix }}">{{ $prefix }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Número" value="{{ old('phone') }}" required>
                                    </div>
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" required>
                                        <label for="password">Contraseña</label>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirmar Contraseña" required>
                                        <label for="password_confirmation">Confirmar Contraseña</label>
                                    </div>
                                </div>

                                <!-- Terms -->
                                <div class="col-md-12 mb-3 text-center">
                                    <div class="form-check">
                                        <label class="form-check-label" for="terms">
                                        <input class="form-check-input" type="checkbox" id="terms" required>
                                            Estoy de acuerdo con los <a href="#termsModal" data-bs-toggle="modal" class="text-primary">Términos y Condiciones</a>
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-md-12 d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">Registrarse</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal de Términos y Condiciones -->
     <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Términos y Condiciones</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                   {!! \App\Helpers\Helper::getTermsAndConditions() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
