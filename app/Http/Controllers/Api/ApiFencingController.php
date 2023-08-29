<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Fencing;
use App\Models\State;
use Illuminate\Http\Request;

class ApiFencingController extends Controller
{
    public function getFencing(){
        $fencing = Fencing::with(['country', 'city', 'state'])->get();

        return response()->json([
            'data' => $fencing
        ]);
    }
    public function getDataCity()
    {
        $city = City::all();

        return response()->json([
            'data' => $city
        ]);
    }
    public function getDataCountry()
    {
        $country = Country::all();

        return response()->json([
            'data' => $country
        ]);
    }
    public function getDataState()
    {
        $state = State::all();

        return response()->json([
            'data' => $state
        ]);
    }
    public function storeFencing(Request $request){
        Fencing::create($request->all());

    return response()->json([
        'message' => 'Data inserted successfully.',
    ]);
    }
    public function deleteFencing($id)
    {
    try {
        $fencing = Fencing::findOrFail($id);
        $fencing->delete();

        return response()->json([
            'message' => 'Data deleted successfully.',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error deleting data.',
        ], 500);
    }
    }

    public function showFencing($id){
        $fencing = Fencing::with(['country', 'city', 'state'])->findorfail($id);

        return response()->json([
            'data' => $fencing
        ]);
    }


}