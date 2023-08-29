<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\LoginEvent;


class LoginController extends Controller
{   
   
    public function login(){
        return view('login');
    }
    public function postlogin(Request $request){
       $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        event(new LoginEvent($user->name, $user->email, $user->role, $user->ip_address, $user->browser));

        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
    }
    public function signout(){
        Auth::logout();

        return redirect('/login');
    }
    public function register(){
        return view('register');
    }
    public function postregister(Request $request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'user',
            'password' => bcrypt($request->password)
        ]);

        return redirect('/login');
    }
}