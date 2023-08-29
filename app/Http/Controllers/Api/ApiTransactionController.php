<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Taxi;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiTransactionController extends Controller
{
    public function getTransactions(){
        $trans = Transaction::with('taxi')->get();

        return response()->json([
            'data' => $trans
        ]);
    }
      public function storeTransaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'driver_name' => 'required',
            'amount' => 'required|numeric',
            'transaction_time' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $transaction = new Transaction();
        $transaction->driver_name = $request->input('driver_name');
        $transaction->amount = $request->input('amount');
        $transaction->transaction_time = $request->input('transaction_time');
        $transaction->save();

        return response()->json(['message' => 'Transaction saved successfully']);
    }
    public function deleteTransaction($id){
        $trans = Transaction::findorfail($id);
        $trans->delete();

        return response()->json([
            'message' => 'Success delete transactions'
        ]);
    }
    public function showTaxi(){
        $taxi = Taxi::all();

        return response()->json([
            'data' => $taxi
        ]);
    }
}