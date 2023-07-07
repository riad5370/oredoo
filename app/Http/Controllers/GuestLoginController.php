<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class GuestLoginController extends Controller
{
    public function index(){
        return view('frontend.auth.user-login');
    }
    public function guestLogin(Request $request){
        if(Auth::guard('guestlogin')->attempt(['email'=>$request->email, 'password'=>$request->password])){
            if(Auth::guard('guestlogin')->user()->email_verified_at == null){
                Auth::guard('guestlogin')->logout();
                return Redirect::route('verify.mail.req')->with([
                    'error'=>'Plesse Verify Your Mail First! Check Your email',
                    'mail'=>$request->email
                ]);
            }
            else{
                return redirect()->route('index')->withSuccess('You have successfully login');
            }
            
        }else{
            return back()->with('error','Whoops! Something went wrong.These credentials do not match our records');
        }
    }
    public function logout(){
        Auth::guard('guestlogin')->logout();
        return Redirect::route('login.index');
    }
    
}
