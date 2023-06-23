<?php

namespace App\Http\Controllers;

use App\Models\Guestlogin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Exists;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function redirectProvider(){
        return Socialite::driver('github')->redirect();
    }
    public function providerToApplication(){
        $user = Socialite::driver('github')->user();
        
        if(Guestlogin::where('email',$user->getEmail())->Exists()){
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
