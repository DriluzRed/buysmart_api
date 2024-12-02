@extends('frontend.layouts.auth')

@section('content')
<section class="vh-100" style="">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 15px;">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <img src="{{ $config['auth_logo'] }}" alt="Logo" class="img-fluid mb-3" style="max-width: 150px;">
                            <h3 class="mb-3 fw-bold">Iniciar Sesión</h3>
                        </div>
                        <form method="POST" action="{{ route('customer.login') }}">
                            @csrf
                            <div class="form-floating mb-4">
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Correo electrónico" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <label for="email">Correo Electrónico</label>
                                @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" required autocomplete="current-password">
                                <label for="password">Contraseña</label>
                                @error('password')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Recuérdame
                                </label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary-custom btn-lg btn-block" type="submit">Iniciar Sesión</button>
                            </div>
                            @if (Route::has('customer.password.request'))
                                <div class="text-center mt-3">
                                    <a class="small text-muted" href="{{ route('customer.password.request') }}">¿Olvidaste tu contraseña?</a>
                                </div>
                            @endif
                            <div class="text-center mt-3">
                                <span>¿No tienes una cuenta?</span> 
                                <a href="{{ route('customer.register') }}" class="text-primary">Regístrate</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
