<?php

namespace App\Http\Controllers;

use App\Models\Guestlogin;
use App\Models\GuestPassReset;
use App\Notifications\PassResetNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class GuestPassResetController extends Controller
{
    public function index(){
        return view('frontend.auth.forgot-password');
    }
    public function passResetRequest(Request $request){
        $guestInfo = Guestlogin::where('email', $request->email)->firstOrFail();
        GuestPassReset::where('guest_id',$guestInfo->id)->delete();
       
        $guestInsert = GuestPassReset::create([
            'guest_id'=>$guestInfo->id,
            'token'=>uniqid(),
            'created_at'=>Carbon::now(),
        ]);
        Notification::send($guestInfo, new PassResetNotification($guestInsert));
        return back()->withReqsend('We have sent you a password reset link! please check your email');
    }
    public function passResetForm($token){
        if(GuestPassReset::where('token', $token)->exists()){
            return view('frontend.auth.pass-reset-form',[
                'token'=>$token
            ]);
        }
        else{
            abort('404');
        }
        
    }
    public function passwordReset(Request $request){
        $guest_info = GuestPassReset::where('token',$request->token)->firstOrFail();
        Guestlogin::findOrFail($guest_info->guest_id)->update([
            'password'=>bcrypt($request->password)
        ]);
        $guest_info->delete();
        return redirect()->route('login.index')->withResetsucces('Password Reset Successfully');
    }
}
