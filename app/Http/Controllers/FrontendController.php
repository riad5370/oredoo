<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
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
    public function details($slug){
        $detailsPost = Post::where('slug',$slug)->first();
        $comments = Comment::with('replies')->where('post_id',$detailsPost->id)->whereNull('parent_id')->get();
        return view('frontend.post.details_post',[
            'detailsPost'=>$detailsPost,
            'comments'=>$comments
        ]);
    }
    public function categoryPost($category){
        $categoryPost = Post::where('category_id',$category)->paginate(5);
        $category = Category::find($category);
        return view('frontend.post.category_post',[
            'categoryPost'=>$categoryPost,
            'category'=>$category
        ]);
    }
    public function authorPost($author){
        $authorPost = Post::where('author_id',$author)->paginate(5);
        return view('frontend.post.author_post',[
            'authorInfo'=>User::find($author),
            'authorPost'=>$authorPost,
            'tags'=>Tag::all()
        ]);
    }
    public function authorList(){
        $authorLists = Post::select('author_id')
                       ->groupBy('author_id')
                       ->paginate(6);
        return view('frontend.about.author-list',[
            'authorLists'=>$authorLists
        ]);
    }
}
