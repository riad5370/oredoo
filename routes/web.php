<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GuestRegisterController;
use App\Http\Controllers\GuestLoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//frontend
Route::get('/',[FrontendController::class,'index'])->name('index');
Route::get('/details/post/{slug}',[FrontendController::class,'details'])->name('details');
Route::get('/category/post/{category}',[FrontendController::class,'categoryPost'])->name('category.post');
Route::get('/author-post/{author}',[FrontendController::class,'authorPost'])->name('author.post');
Route::get('/author/list',[FrontendController::class,'authorList'])->name('author.list');

//Guest-login-register
Route::get('/guest/register',[GuestRegisterController::class,'index'])->name('guest.register');
Route::post('/guest/store',[GuestRegisterController::class,'store'])->name('guest.store');

Route::get('/guest/login',[GuestLoginController::class,'index'])->name('login.index');
Route::post('/guest/login/request',[GuestLoginController::class,'guestLogin'])->name('guest.login');

Route::middleware([
    'auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

   //start-user
    Route::resource('user',UserController::class);
    Route::post('/multi/delete',[UserController::class,'multiDelete'])->name('multi.delete');
    Route::post('/photo/update',[UserController::class,'photoUpdate'])->name('photo.update');
    Route::get('/trash',[UserController::class,'trash'])->name('trash');
    Route::post('/force/delete',[UserController::class,'forceDeleteOrRestore'])->name('force.delete');
    
    //start-category
     Route::resource('categorys',CategoryController::class);
     Route::get('/category/status/{id}',[CategoryController::class,'status'])->name('categorys.status');
     //Tag
     Route::resource('tags',TagController::class);
     Route::get('/tags/status/{id}',[TagController::class,'status'])->name('tags.status');

     //blog-post 
     Route::resource('posts',PostController::class);

    //Role
    Route::get('role',[RoleController::class,'index'])->name('role.index');
    Route::post('/permission/store',[RoleController::class,'storePermission'])->name('permission.store');
    Route::post('/role/store',[RoleController::class,'storeRole'])->name('role.store');
    Route::post('/assign/role',[RoleController::class,'assignRole'])->name('assign.role');
    Route::get('/remove/role/{id}',[RoleController::class,'removeRole'])->name('remove.role');
    Route::get('/role/permission/edit/{id}',[RoleController::class,'permissionEdit'])->name('edit.user.permission');
    Route::post('/permission/update',[RoleController::class,'permissionUpdate'])->name('permission.update');


});