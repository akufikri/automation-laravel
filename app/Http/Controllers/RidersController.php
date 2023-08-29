<?php

namespace App\Http\Controllers;

use App\Models\Riders;
use Illuminate\Http\Request;

class RidersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Layouts.riders');
    }

}