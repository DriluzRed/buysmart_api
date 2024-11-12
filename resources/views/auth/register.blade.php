@extends('frontend.layouts.customer')
@section('content')
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registrarse</p>
  
                <form method="POST" action="{{ route('customer.register') }}">
                    @csrf
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-id-card fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <input type="text" id="ci" class="form-control" name="ci" value="{{ old('ci') }}" required autocomplete="ci" autofocus />
                            <label class="form-label
                            " for="ci">Cédula de Identidad</label>
                            @error('ci')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />
                            <label class="form-label" for="name">Nombre</label>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-calendar fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <input type="text" id="birthdate" class="form-control datepicker" name="birthdate" value="{{ old('birthdate') }}" required autocomplete="birthdate" autofocus/>
                            <label class="form-label
                            " for="birthdate">Fecha de Nacimiento</label>
                            @error('birthdate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" />
                            <label class="form-label" for="email">Email</label>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-phone fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <div class="input-group mb-3">
                                <select name="prefix" id="prefix" class="form-select " style="max-width: 100px;">
                                    @foreach (\App\Helpers\Helper::phonePrefixes() as $prefix)
                                        <option value="{{ $prefix }}">{{ $prefix }}</option>
                                    @endforeach
                                </select>
                                <input type="text" id="phone" class="form-control" name="phone" value="{{ old('phone') }}" required autocomplete="phone" />
                            </div>
                            <label class="form-label" for="phone">Teléfono</label>
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <input type="password" id="password" class="form-control" name="password" required autocomplete="new-password" />
                            <label class="form-label" for="password">Contraseña</label>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required autocomplete="new-password" />
                            <label class="form-label" for="password_confirmation">Repite la Contraseña</label>
                        </div>
                    </div>
                
                    <div class="form-check d-flex justify-content-center mb-5">
                        <input class="form-check-input me-2" type="checkbox" value="" id="terms" required />
                        <label class="form-check-label" for="terms">
                            Estoy de acuerdo con los <a href="#!" onclick="">Términos de Servicio</a>
                        </label>
                    </div>
                
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-lg">Registrarse</button>
                    </div>
                </form>
                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                  <img src="/img/logo.png" alt="Logo"
                    class="img-fluid">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
  