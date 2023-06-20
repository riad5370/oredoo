<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $sliderPost = Post::latest('created_at')->take(3)->get();
        $recentPost = Post::latest('created_at')->paginate(5);
        return view('frontend.index',[
            'sliderPost'=>$sliderPost,
            'recentPost'=>$recentPost,
            'categories'=>Category::all(),
            'tags'=>Tag::all()
        ]);
    }
    public function details(){
        return view('frontend.post.details_post');
    }
}
