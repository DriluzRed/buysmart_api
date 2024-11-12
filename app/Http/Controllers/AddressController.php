<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Requests\Address\StoreAddressRequest;
use App\Http\Requests\Address\UpdateAddressRequest;
use App\Models\City;
use App\Models\Neighborhood;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request)
    {
        $address = new Address();
        $address->customer_id = Auth::guard('customer')->user()->id;
        $address->address_line_1 = $request->address_line_1;
        $address->address_line_2 = $request->address_line_2;
        $address->department_id = $request->department_id;
        $address->city_id = $request->city_id;
        $address->neighborhood_id = !empty($request->neighborhood_id) ? $request->neighborhood_id : null;
        $address->type = $request->type;
        $address->is_main = $request->is_main === 'true' ? 1 : 0;
        $address->for_billing = $request->for_billing === 'true' ? 1 : 0;
        if($address->save()){
            return response()->json([200, 'success' => 'Dirección creada correctamente']);
        }
        return response()->json([500, 'error' => 'Error al crear la dirección']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, Address $address)
    {
        $address = Address::find($request->id);
        if (!$address) {
            return response()->json([404, 'message' => 'Dirección no encontrada']);
        }
        
        $address->customer_id = Auth::guard('customer')->user()->id;
        $address->address_line_1 = $request->address_line_1;
        $address->address_line_2 = $request->address_line_2;
        $address->department_id = $request->department_id;
        $address->city_id = $request->city_id;
        $address->neighborhood_id = !empty($request->neighborhood_id) ? $request->neighborhood_id : null;
        $address->type = $request->type;
        $address->is_main = $request->is_main === 'true' ? 1 : 0;
        $address->for_billing = $request->for_billing === 'true' ? 1 : 0;
    
        if ($address->save()) {
            return response()->json([200, 'success' => 'Dirección actualizada correctamente']);
        }
    
        return response()->json([500, 'error' => 'Error al actualizar la dirección']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $address = Address::find($id);  
        if($address->delete()){
            return response()->json([200, 'success' => 'Dirección eliminada correctamente']);
        }
        return response()->json([500, 'error' => 'Error al eliminar la dirección']);
    }

    public function getCities(Request $request)
    {
        $departmentId = $request->input('department_id');
        $cities = City::where('department_id', $departmentId)->pluck('name', 'id');

        return response()->json($cities);
    }

    public function getNeighborhoods(Request $request)
    {
        $cityId = $request->input('city_id');
        $neighborhoods = Neighborhood::where('city_id', $cityId)->pluck('name', 'id');

        return response()->json($neighborhoods);
    }
}
