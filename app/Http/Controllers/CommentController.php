<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request){
        Comment::create([
            'post_id'=>$request->post_id,
            'guest_id'=>Auth::guard('guestlogin')->id(),
            'comment'=>$request->comment,
            'parent_id'=>$request->parent_id,
            'created_at'=>Carbon::now()
        ]);
        return back();
    }
}
