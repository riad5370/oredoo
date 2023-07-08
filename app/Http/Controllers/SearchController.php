<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PopularPost;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $data = $request->all();
        $searchePost = Post::where(function ($q) use ($data){
            if(!empty($data['q']) && $data['q'] != '' && $data['q'] != 'undefined'){
                $q->where(function ($q) use ($data){
                    $q->where('title', 'like','%'.$data['q'].'%');
                    $q->orWhere('description', 'like','%'.$data['q'].'%');
                });
            }
        })->Paginate(5);

        $popular_posts = PopularPost::groupBy('post_id')
            ->selectRaw('post_id, sum(total_view) as sum')
            ->orderBy('sum','DESC')
            ->paginate(4);

        $categories = Category::all();
        $tags = Tag::all();
        return view('frontend.search.search',[
            'categories'=>$categories,
            'tags'=>$tags,
            'searchPost'=>$searchePost,
            'popular_posts'=>$popular_posts
        ]);
    }
    
}
