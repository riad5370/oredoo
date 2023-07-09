<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.category.index',[
            'categorys'=>Category::all(),
            'total_category'=>Category::count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function status($id){
        $status = Category::find($id);
        if($status->status == 0){
            $status->status = 1;
        }else{
            $status->status = 0;
        }
        $status->save();
        return back();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $id = Category::insertGetId([
            'name'=>$request->name,
            'created_at'=>Carbon::now()
        ]);
        $uploaded_file = $request->image;
        $name = Str::lower(str_replace(' ','-',$request->name)).'-'.rand(100000,999999).'.'.$uploaded_file->extension();
        Image::make($uploaded_file)->resize(250,200)->save(public_path('uploads/category/'.$name));
        Category::find($id)->update([
            'image'=>$name,
        ]);
        return back()->with('success','Category Added!');
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
        return view('admin.category.edit',[
            'category'=>Category::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->image == ''){
            Category::find($id)->update([
                'name'=>$request->name
            ]);
            return redirect()->route('categorys.index')->withSuccess('category Updated!');
        }
       else{
            $category = Category::find($id);
            if(file_exists(public_path('uploads/category/'.$category->image))){
                unlink(public_path('uploads/category/'.$category->image));
            }
            $uploaded_file = $request->image;
            $file_name = Str::lower(str_replace(' ','-',$request->name)).'-'.rand(100000,999999).'.'.$uploaded_file->extension();
            echo $file_name;
            Image::make($uploaded_file)->resize(250,200)->save(public_path('uploads/category/'.$file_name));
            Category::find($id)->update([
                'name'=>$request->name,
                'image'=>$file_name
            ]);
            return redirect()->route('categorys.index')->withSuccess('category Updated!');
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::where('category_id', $id)->get();

        foreach ($post as $post) {
            Post::find($post->id)->update([
                'category_id' => 10,
            ]);
        }

        $category = Category::find($id);
        if($category->image){
            if(file_exists(public_path('uploads/category/'.$category->image))){
                unlink(public_path('uploads/category/'.$category->image));
            }
        }
        $category->delete();
        return back()->withSuccess('delete successfull!');
    }
}
