<?php

namespace App\Http\Controllers;

use App\Models\Taxi;
use Illuminate\Http\Request;

class TaxiController extends Controller
{
   public function taxi(){
        return view('Layouts.taxi');
   }
   public function available(){
      $available = Taxi::where('status', 'available')->get();

      return view('Layouts.status_taxi.available', compact('available'));
   }
   public function booked(){
      $booked = Taxi::where('status', 'booked')->get();

      return view('Layouts.status_taxi.booked', compact('booked'));
   }
   public function on_ride(){
      $on_ride = Taxi::where('status', 'on ride')->get();

      return view('Layouts.status_taxi.on_ride', compact('on_ride'));
   }
   public function under_maintence(){
      $under_maintence = Taxi::where('status', 'under maintence')->get();

      return view('Layouts.status_taxi.under_maintence', compact('under_maintence'));
   }
}