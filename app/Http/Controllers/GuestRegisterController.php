<?php

namespace App\Http\Controllers;

use App\Models\Guestlogin;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GuestRegisterController extends Controller
{
    public function index(){
        return view('frontend.auth.user-register');
    }
    public function store(Request $request){
        Guestlogin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now()
        ]);
        return back();
    }
}
