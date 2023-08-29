<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class ApiCountryController extends Controller
{
    public function getCountry(){
        $country = Country::all();

        return response()->json([
            'data' => $country
        ]);
    }
    public function storeCountry(Request $request){
        Country::create($request->all());

        return response()->json([
            'message' => 'Country success added'
        ]);
    }
    public function showCountry($id){
        $country = Country::findorfail($id);

        return response()->json([
            'data' => $country
        ]);
    }
    public function deleteCountry($id){
        $country = Country::findorfail($id);
        $country->delete();

        return response()->json([
            'message' => 'Country success deleted'
        ]);
    }
    public function updateCountry(Request $request, $id){
        
        $country = Country::find($id);
        $country->update($request->all());

        return response()->json([
            'message' => 'Country success updated',
        ]);
    }
}