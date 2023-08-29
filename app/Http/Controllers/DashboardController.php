<?php

namespace App\Http\Controllers;

use App\Models\Taxi;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $totalAmount = Transaction::sum('amount');
        $taxi = Taxi::all();
        return view('Layouts.dashboard', compact('totalAmount', 'taxi'));
    }
}