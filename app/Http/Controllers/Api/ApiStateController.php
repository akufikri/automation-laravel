<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

class ApiStateController extends Controller
{
    public function getState(){
        $state = State::all();

        return response()->json([
            'data' => $state
        ]);
    }
    public function storeState(Request $request){
        State::create($request->all());

        return response()->json([
            'message' => 'State success added'
        ]);
    }
    public function showState($id){
        $state = State::findorfail($id);
        return response()->json([
            'data' => $state
        ]);
    }

     public function deleteState($id){
        $state = State::findorfail($id);
        $state->delete();

        return response()->json([
            'message' => 'State success deleted'
        ]);
    }
    public function updateState(Request $request, $id){
        $state = State::find($id);
        $state->update($request->all());

        return response()->json([
            'message' => 'State success updated'
        ]);
    }
    
}