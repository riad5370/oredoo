<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tag.index',[
            'tags'=>Tag::all(),
            'total_tag'=>Tag::count()
        ]);
    }

    public function status($id){
        $tag = Tag::find($id);  
        if($tag->status == 0){
            $tag->status = 1;
        }else{
            $tag->status =0;
        } 
        $tag->save();
        return back();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:tags',
        ]);
        Tag::insert([
            'name'=>$request->name
        ]);
        return Redirect::route('tags.index')->withSuccess('Tag inserted!');
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
        return view('admin.tag.edit',[
            'tag'=>Tag::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'unique:tags'
        ]);
        Tag::find($id)->update([
            'name'=>$request->name
        ]);
        return redirect()->route('tags.index')->withSuccess('updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tag::find($id)->delete();
        return back()->withSuccess('delete successfull!');
    }
}
