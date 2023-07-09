<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Inbox;
use App\Models\PopularPost;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $sliderPost = Post::latest('created_at')->take(3)->get();
        $recentPost = Post::latest('created_at')->paginate(6);

        $popular_posts = PopularPost::groupBy('post_id')
            ->selectRaw('post_id, sum(total_view) as sum')
            ->orderBy('sum','DESC')
            ->paginate(4);

        return view('frontend.index',[
            'sliderPost'=>$sliderPost,
            'recentPost'=>$recentPost,
            'categories'=>Category::all(),
            'tags'=>Tag::all(),
            'popular_posts'=>$popular_posts
        ]);
    }
    public function details($slug){
        $detailsPost = Post::where('slug',$slug)->first();

        //most-view-process
        $ip = getHostByName(getHostName());
        if(PopularPost::where('post_id',$detailsPost->id)->exists()){
            PopularPost::where('post_id',$detailsPost->id)->increment('total_view',1);
        }
        else{
            PopularPost::insert([
                'post_id'=>$detailsPost->id,
                'total_view'=> 1,
                'created_at'=>Carbon::now()
            ]);
        }
        //end-most-view

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

        $popular_posts = PopularPost::groupBy('post_id')
            ->selectRaw('post_id, sum(total_view) as sum')
            ->orderBy('sum','DESC')
            ->paginate(3);

        return view('frontend.post.author_post',[
            'authorInfo'=>User::find($author),
            'authorPost'=>$authorPost,
            'tags'=>Tag::all(),
            'categories'=>Category::all(),
            'popular_posts'=>$popular_posts
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
   //contact-page............................................
    public function contact(){
        return view('frontend.contact.contact');
    }
    public function messageSent(Request $request){
        Inbox::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message,
            'created_at'=>Carbon::now()
        ]);
        return back()->withSuccess('Your message was sent successfully.');
    }
}
