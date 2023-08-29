<?php

namespace App\Http\Controllers;

use App\Models\HistoryLogin;
use Illuminate\Http\Request;

class HistoryLoginController extends Controller
{
    public function history_login(){
        $his_login = HistoryLogin::all();

        return view('Layouts.history_log', compact('his_login'));
    }
    public function deleteHistory($id){
        $his_log = HistoryLogin::findorfail($id);
        $his_log->delete();
        return redirect()->back();
    }
}