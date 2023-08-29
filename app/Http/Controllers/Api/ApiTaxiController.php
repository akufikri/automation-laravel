<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Taxi;
use Illuminate\Http\Request;

class ApiTaxiController extends Controller
{
    public function getTaxi(){
        $taxi = Taxi::all();

        return response()->json(
            [
                'data' => $taxi,
            ]
        );
    }
    public function storeTaxi(Request $request){
        Taxi::create($request->all());

        return response()->json([
            'message' => 'Data success added'
        ], 200);
    }
    public function deleteTaxi($id){

        $taxi = Taxi::findorfail($id);
        $taxi->delete();

        return response()->json([
            'message' => 'Data success di hapus'
        ]);
    }
    public function showTaxi($id){
        $taxi = Taxi::find($id);

        return response()->json([
            'data' => $taxi,
            'message' => 'Data success di muat'
        ]); 
    }
    public function updateTaxi(Request $request, $id){
        $taxi = Taxi::find($id);
        $taxi->update($request->all());

        return response()->json([
         'message' => 'Data success di update'
         ]);

    }
}