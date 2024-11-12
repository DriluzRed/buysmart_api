<?php
namespace App\Http\Controllers\CustomerAuth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CustomerChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    public function changePassword(Request $request)
    {
        return view('auth.passwords.change');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|string|min:6',
            ],
            [
                'current_password.required' => 'El campo contraseña actual es obligatorio',
                'new_password.required' => 'El campo nueva contraseña es obligatorio',
            ]
        );

        $customer = Customer::find(auth()->guard('customer')->user()->id);

        if (!Hash::check($request->current_password, $customer->password)) {
            return back()->with('error', 'La contraseña actual no es correcta!');
        }

        $customer->password = Hash::make($request->new_password);
        $customer->save();

        return redirect()->route('home ')->with('success', 'Contraseña actualizada correctamente!');
    }


}