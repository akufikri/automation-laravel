<?php

namespace App\Http\Controllers;

use App\Models\Taxi;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompareController extends Controller
{
  
      public function comparizon(){

        $data = Transaction::with('taxi')->get();
        $taxi = Taxi::all();

        return view('Layouts.comparizon', compact('data', 'taxi'));
    }
    public function compare(Request $request) {
    $selectedDrivers = $request->input('drivers', []);
    $taxi = Taxi::all();
    
    $data = Transaction::whereIn('taxi_id', $selectedDrivers)->pluck('amount');
    
    return view('Layouts.comparizon', compact('data', 'taxi'));
}

}