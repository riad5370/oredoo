<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function index(){
        return view('admin.role.role',[
            'permissions'=>Permission::all(),
            'roles'=>Role::all(),
            'users'=>User::all()
        ]);
    }
    function storePermission(Request $request){
        Permission::create([
            'name' => $request->permission_name,
            'guard_name' => 'web',
        ]);
        return back();
    }
    public function storeRole(Request $request){
        $role = Role::create(['name' =>$request->role_name,'guard_name' => 'web',]);
        $role->givePermissionTo($request->permission);
        return back();
    }
    public function assignRole(Request $request){
        $user = User::find($request->user_id);
        $user->assignRole($request->role_id);
        return back();
    }
}
