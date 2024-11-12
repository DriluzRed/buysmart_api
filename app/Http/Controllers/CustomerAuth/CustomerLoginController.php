<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validar los datos del formulario
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ],
        [
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El campo email debe ser una dirección de correo válida',
            'password.required' => 'El campo contraseña es obligatorio',
        ]
    );

        // Intentar iniciar sesión
        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Redirigir a la página de inicio de clientes
            return redirect()->intended(route('home'));
        }

        // Si falla el inicio de sesión, redirigir de vuelta al formulario de inicio de sesión con los datos del formulario
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function changePassword()
    {
        Auth::guard('customer')->user();
        return view('auth.passwords.change');

    }
}