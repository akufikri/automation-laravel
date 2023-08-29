<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\PinMap;
use Illuminate\Http\Request;

class ApiPinMapController extends Controller
{
    public function getPinMap()
    {
            $pinmap = PinMap::with(['country', 'city'])->get();

            return response()->json([
                  'data' => $pinmap
            ]);
    }
    public function getDataCountry()
    {
        $country = Country::all();

        return response()->json([
            'data' => $country
        ]);
    }
    public function getDataCity(){
        $city = City::all();

        return response()->json([
            'data' => $city
        ]);
    }
    public function storePinMap(Request $request)
    {
        PinMap::create($request->all());

        return response()->json([
            'message' => 'Pin Map success added'
        ]);
    }
    public function deletePinMap($id)
    {
        $pin = PinMap::find($id);
        $pin->delete($id);

        return response()->json([
            'message' => 'Data success deleted'
        ]);
    }
    public function showPinMap($id){
        $pin = PinMap::with(['country', 'city'])->find($id);

        return response()->json([
            'data' => $pin
        ]);
    }
    public function updatePinMap(Request $request, $id)
    {
        $pin = PinMap::find($id);
        $pin->update($request->all());

        return response()->json([
            'message' => 'Data success updated'
        ]);
    }
}