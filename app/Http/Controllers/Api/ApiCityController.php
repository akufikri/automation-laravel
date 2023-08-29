<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class ApiCityController extends Controller
{
   public function getCity(){
        $city = City::all();
        return response()->json([
            'data' => $city
        ]);
   }
       public function storeCity(Request $request){
        City::create($request->all());

        return response()->json([
            'message' => 'City success added'
        ]);
    }
    public function showCity($id){
        $city = City::findorfail($id);

        return response()->json([
            'data' => $city
        ]);
    }
    public function deleteCity($id){
        $city = City::findorfail($id);
        $city->delete();

        return response()->json([
            'message' => 'City success deleted'
        ]);
    }
    public function updateCity(Request $request, $id){
        
        $city = City::find($id);
        $city->update($request->all());

        return response()->json([
            'message' => 'City success updated',
        ]);
    }
}