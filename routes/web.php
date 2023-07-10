<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\RoleController;
//start-frontend
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GuestRegisterController;
use App\Http\Controllers\GuestLoginController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GuestPassResetController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SearchController;



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

//Start-Frontend-Route
Route::get('/',[FrontendController::class,'index'])->name('index');
Route::get('/details/post/{slug}',[FrontendController::class,'details'])->name('details');
Route::get('/category/post/{category}',[FrontendController::class,'categoryPost'])->name('category.post');
Route::get('/author-post/{author}',[FrontendController::class,'authorPost'])->name('author.post');
Route::get('/author/list',[FrontendController::class,'authorList'])->name('author.list');
Route::get('/blogs',[FrontendController::class,'blog'])->name('blogs');
//contact
Route::get('/contact-us',[FrontendController::class,'contact'])->name('contact');
Route::post('/message/sent',[FrontendController::class,'messageSent'])->name('message.sent');
//about
Route::get('/about-us',[FrontendController::class,'about'])->name('about');

//searching........
Route::get('/search',[SearchController::class,'search'])->name('search');



//Guest-Login-Register
Route::get('/guest/register',[GuestRegisterController::class,'index'])->name('guest.register');
Route::post('/guest/store',[GuestRegisterController::class,'store'])->name('guest.store');
//Login-process
Route::get('/guest/login',[GuestLoginController::class,'index'])->name('login.index');
Route::post('/guest/login/request',[GuestLoginController::class,'guestLogin'])->name('guest.login');
//logout
Route::get('/guest/logout',[GuestLoginController::class,'logout'])->name('guest.logout');

//Github-Login
Route::get('/github/redirect',[GithubController::class,'redirectProvider'])->name('github.redirect');
Route::get('/github/callback',[GithubController::class,'providerToApplication'])->name('github.callback');

//Google-Login
Route::get('/google/redirect',[GoogleController::class,'redirectProvider'])->name('google.redirect');
Route::get('/google/callback',[GoogleController::class,'providerToApplication'])->name('google.callback');

//Email-Verify
Route::get('/verify/mail/{token}', [GuestRegisterController::class, 'verifyMail'])->name('verify.mail');
Route::get('/mail/verify/request',[GuestRegisterController::class,'mailVerifyReq'])->name('verify.mail.req');
Route::post('/mail/verify/again',[GuestRegisterController::class,'mailVerifyAgain'])->name('mail.verify.again');


//password-Reset
Route::get('/forgot-password',[GuestPassResetController::class,'index'])->name('forgot.password');
Route::Post('/password-reset-request',[GuestPassResetController::class,'passResetRequest'])->name('reset.request');
Route::get('/password-reset-form/{token}',[GuestPassResetController::class,'passResetForm'])->name('pass.reset.form');
Route::Post('/password-reset',[GuestPassResetController::class,'passwordReset'])->name('password.reset');

//comments-reply
Route::Post('/comment/store',[CommentController::class,'store'])->name('comment.store');


//Start-AdminPanel-Route
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
    
     //About-us
    Route::get('/about',[AboutController::class,'about'])->name('about.edit');
    Route::post('/about-update',[AboutController::class,'update'])->name('about.update');

     //inbox
    Route::get('/inbox',[InboxController::class,'inbox'])->name('inbox');
    Route::get('/inbox/show/{id}',[InboxController::class,'show'])->name('inbox.show');
    Route::get('/inbox/destroy/{inbox}',[InboxController::class,'destroy'])->name('destroy');
     

    //Role-management
    Route::get('role',[RoleController::class,'index'])->name('role.index');
    Route::post('/permission/store',[RoleController::class,'storePermission'])->name('permission.store');
    Route::post('/role/store',[RoleController::class,'storeRole'])->name('role.store');
    Route::post('/assign/role',[RoleController::class,'assignRole'])->name('assign.role');
    Route::get('/remove/role/{id}',[RoleController::class,'removeRole'])->name('remove.role');
    Route::get('/role/permission/edit/{id}',[RoleController::class,'permissionEdit'])->name('edit.user.permission');
    Route::post('/permission/update',[RoleController::class,'permissionUpdate'])->name('permission.update');
});