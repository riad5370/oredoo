<?php

namespace App\Http\Controllers;

use App\Models\Guestlogin;
use App\Models\GuestMailVerify;
use App\Notifications\GuestMailVerifyNotification;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class GuestRegisterController extends Controller
{
    public function index(){
        return view('frontend.auth.user-register');
    }
    public function store(Request $request){
        $guestInfo = Guestlogin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now()
        ]);

        $guestToken = GuestMailVerify::create([
            'guest_id'=>$guestInfo->id,
            'token'=>uniqid(),
            'created_at'=>Carbon::now()
        ]);

        Notification::send($guestInfo, new GuestMailVerifyNotification($guestToken));
        return back()->withSuccess('We have sent you a Email Verify link! please check your email');
    }
    public function verifyMail($token){
        $guest = GuestMailVerify::where('token',$token)->firstOrFail();
        Guestlogin::findOrFail($guest->guest_id)->update([
            'email_verified_at'=>Carbon::now()->format('Y-m-d')
        ]);
        $guest->delete();
        return Redirect::route('login.index')->withSuccess('Your Email Verified Successfully! Now You Can Login');

    }
    
    public function mailVerifyReq(){
        return view('frontend.auth.mail.verify-mail-request');
    }
    public function mailVerifyAgain(Request $request){
        $guest = Guestlogin::where('email',$request->email)->firstOrFail();
        GuestMailVerify::where('guest_id',$guest->id)->delete();

        $guest_info = GuestMailVerify::create([
            'guest_id'=>$guest->id,
            'token'=>uniqid(),
            'created_at'=>Carbon::now(),
        ]);
        Notification::send($guest, new GuestMailVerifyNotification($guest_info));
        return back()->withReqsend('We have sent you a Email Verify link! please check your email');
    }
}
