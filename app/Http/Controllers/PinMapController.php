<?php

namespace App\Http\Controllers;

use App\Models\PinMap;
use Illuminate\Http\Request;

class PinMapController extends Controller
{
    public function pin(){
        return view('Layouts.pin');
    }

}