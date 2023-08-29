<?php

namespace App\Http\Controllers;

use App\Models\Taxi;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transaction(){
        $taxi = Taxi::all();
        return view('Layouts.transactions', compact('taxi'));
    }
    public function insert_trans(Request $request){
        $validate = $request->validate([
            'taxi_id' => 'required',
            'amount' => 'required|numeric',
            'payment_methode' => 'required'
        ]);
        Transaction::create($validate);

        return redirect()->back();
    }
}