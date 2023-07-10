<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('id','!=',Auth::user()->id)->get();
        $total_user = User::count();
        return view('admin.user.user',[
            'users'=>$users,
            'total_user'=>$total_user
        ]);
    }
    public function trash(){
        $trash_users = User::onlyTrashed()->where('id','!=',Auth::user()->id)->get();
        return view('admin.user.trash',[
            'trash_users'=>$trash_users
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userdata = [
            'name'=> 'required',
            'email'=> 'required|email|unique:users',
            'image'=> 'image|file|max:2048',
            'password'=> 'required|string|min:8',
            'password_confirmation'=> 'required|same:password',
        ];
        $validateData = $request->validate($userdata);
        $validateData['password'] = bcrypt($validateData['password']);

        if( $image = $request->file('image')){
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/user/'), $imageName);
            $validateData['image'] = $imageName;
        }
        User::create($validateData);
        return back()->withSuccess('User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.user.profile-edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->password == ''){
            User::find(Auth::id())->update([
                'name'=>$request->name,
                'email'=>$request->email,
            ]);
            return back()->with('success','Profile Updated!');
        }
        else{
            $request->validate([
                'old_password'=>'required',
                'password'=> 'required|string|min:8',
                'password_confirmation'=> 'required|same:password',
            ]);
            if(Hash::check($request->old_password,auth::user()->password)){
                User::find(auth::id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password)
                    ]);
                    return back()->with('success','profile Updated!');
                }
            else{
                return back()->with('failled','old password is wrong!');
            }
        }
    }
    public function photoUpdate(Request $request){
        $user = User::find(Auth::id());
        if($user->image){
            if(file_exists('uploads/user/'.$user->image)){
                unlink(public_path('uploads/user/'.$user->image));  
            }
        }
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('/uploads/user/'), $imageName);
        $user->update([
           'image'=>$imageName
        ]);
        return back()->with('success','profile image Updated!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function multiDelete(Request $request){
        if($request->click == 1){
            if($request->check == ''){
                return back()->with('select','no data selected');
            }
            else{
                foreach($request->check as $check_user){
                    User::find($check_user)->delete();
                }
            }
        }
        else{
           User::find($request->click)->delete();
        }
        return back()->with('success','Checked delete successfully!');
    }
    
    public function forceDeleteOrRestore(Request $request){
        if($request->click == 1){
            if($request->check == ''){
                return back()->with('select','no data selected');
            }
            else{
                foreach($request->check as $user){
                    $user = User::onlyTrashed()->find($user);
                    if($user->image){
                        if(file_exists(public_path('uploads/user/'.$user->image))){
                            unlink(public_path('uploads/user/'.$user->image));
                        }
                    }
                    $user->forceDelete();
                }
                return back()->with('success','Checked delete successfully!');
            }
        }else{
           if($request->check == ''){
                return back()->with('select','no data selected');
           }else{
            foreach($request->check as $user){
                User::withTrashed()->find($user)->restore();
            }
            return back()->with('restore','data restored!');
           }
        }
    }

    public function destroy(string $id)
    {
      //  
    }
}
