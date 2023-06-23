<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guestlogin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleController extends Controller
{
    public function redirectProvider(){
        return Socialite::driver('google')->redirect();
    }
    public function providerToApplication(){
        $user = Socialite::driver('google')->user();

        if(Guestlogin::where('email',$user->getEmail())->exists()){
            if(Auth::guard('guestlogin')->attempt(['email'=>$user->getEmail(), 'password'=>'abir@123'])){
                return redirect()->route('index')->withSuccess('You have successfully login');
            } 
        }
        else{
            Guestlogin::create([
                'name'=>$user->getName(),
                'email'=>$user->getEmail(),
                'password'=>bcrypt('abir@123'),
                'created_at'=>Carbon::now()
            ]);
            if(Auth::guard('guestlogin')->attempt(['email'=>$user->getEmail(), 'password'=>'abir@123'])){
                return redirect()->route('index')->withSuccess('You have successfully login');
            }
        }
        
            
        
           
    }
}
