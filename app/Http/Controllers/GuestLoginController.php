<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestLoginController extends Controller
{
    public function index(){
        return view('frontend.auth.user-login');
    }
    public function guestLogin(Request $request){
        if(Auth::guard('guestlogin')->attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect()->route('index');
        }else{
            return back();
        }
    }
    
}
