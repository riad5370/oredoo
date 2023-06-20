<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('author_id',Auth::id())->get();
        return view('admin.post.index',[
            'posts'=>$posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.post.create',[
            'categories'=>Category::all(),
            'tags'=>Tag::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $after_implode_tag = implode(',', $request->tag_id);
        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/post/'), $imageName);
        }
        Post::create([
            'author_id'=>Auth::id(),
            'category_id'=>$request->category_id,
            'title'=>$request->title,
            'short_desp'=>$request->short_desp,
            'description' => $request->description,
            'tag_id'=>$after_implode_tag,
            'image' => $imageName,
            'slug' => Str::lower(str_replace(' ', '-', $request->title)) . '-' . rand(1000000000, 9999999999),
            'created_at'=>Carbon::now()
        ]);
        return redirect()->route('posts.index')->with('success', 'Post has been created!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.post.view',[
            'post'=>$post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.post.edit',[
            'categories'=>Category::all(),
            'tags'=>Tag::all(),
            'post'=>$post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $after_implode_tag = implode(',', $request->tag_id);
            
        $data = [
            'author_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'short_desp'=>$request->short_desp,
            'description' => $request->description,
            'tag_id' => $after_implode_tag,
            'slug' => Str::lower(str_replace(' ', '-', $request->title)) . '-' . rand(1000000000, 9999999999),
            'created_at' => Carbon::now()
        ];
            
        if ($request->image == '') {
            Post::find($id)->update($data);
        } else {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/post/'), $imageName);
            $data['image'] = $imageName;
            Post::find($id)->update($data);
        }
            
        return redirect()->route('posts.index')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if($post->image){
            if(file_exists(public_path('uploads/post/'.$post->image))){
                unlink(public_path('uploads/post/'.$post->image));
            }
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post has been Deleted!');
    }
}
