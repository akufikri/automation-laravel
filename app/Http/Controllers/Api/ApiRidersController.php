<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Riders;
use App\Models\Taxi;
use App\Models\User;
use Illuminate\Http\Request;

class ApiRidersController extends Controller
{
    public function getRiders(){
        $ride = Riders::with(['taxi', 'user'])->get();

        return response()->json([
            'data' => $ride
        ]);
    }
    public function getDataUsers(){
        $users = User::all();
        return response()->json(
          [
              'data' => $users
          ]
        );
    }
    public function getDataTaxi(){
        $taxi = Taxi::all();
        return response()->json([
            'data' => $taxi
        ]);
    }
    public function storeRiders(Request $request)
    {
          // Validasi data dari $request
    $validatedData = $request->validate([
        'user_id' => 'required',
        'taxi_id' => 'required',
        'start_location' => 'required',
        'end_location' => 'required',
        'status' => 'required',
        'start_time' => 'required',
        'end_time' => 'nullable|date',
    ]);

    // Simpan data ke database
    $rider = new Riders();
    $rider->user_id = $validatedData['user_id'];
    $rider->taxi_id = $validatedData['taxi_id'];
    $rider->start_location = $validatedData['start_location'];
    $rider->end_location = $validatedData['end_location'];
    $rider->status = $validatedData['status'];
    $rider->start_time = $validatedData['start_time'];
    $rider->end_time = $validatedData['end_time'];
    $rider->save();
     return response()->json(['message' => 'Rider created successfully'], 201);
    }
    public function deleteRiders($id){
        $riders = Riders::findorfail($id);
        $riders->delete();

        return response()->json([
            'message' => 'data sukses di hapus'
        ]);
    }
    
    public function showRiders($id){
        $riders = Riders::with(['taxi', 'user'])->find($id);

        return response()->json([
         'data' => $riders
        ]);
    }
   public function updateRiders(Request $request, $id)
    {
        $riders = Riders::with(['taxi', 'user'])->find($id);
        $riders->update($request->all());

        return response()->json([
            'message' => 'Data sukses di update'
        ]);
   }


}