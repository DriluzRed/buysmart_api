<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\City;
use App\Models\Neighborhood;

class CustomerController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $cities = City::all();
        $neighborhoods = Neighborhood::all();
        $customer = auth()->guard('customer')->user();
        $addresess = $customer->addresses->where('deleted_at', null);
        $addresess->load('neighborhood', 'city', 'department');
        $creditCards = $customer->creditCards->where('deleted_at', null);
        return view('frontend.customer.index')->with('customer', $customer)->with('addresses', $addresess)->with('departments', $departments)->with('cities', $cities)->with('neighborhoods', $neighborhoods)->with('creditCards', $creditCards);
    }

    public function update(Request $request, $id)
    {
        $customer = auth()->guard('customer')->user();
        $formattedDate = date('Y-m-d', strtotime($request->birthdate));
        $request->merge(['birthdate' => $formattedDate]);
        if($customer->update($request->all())){
            return response()->json(['success' => 'Datos actualizados correctamente']);
        }
        return response()->json(['error' => 'Error al actualizar los datos']);
    }

}
