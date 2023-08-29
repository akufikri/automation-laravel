<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FencingController extends Controller
{
    public function fencing(){
        return view('Layouts.fencing');
    }
}