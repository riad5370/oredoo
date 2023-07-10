<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about(){

        return view('admin.about.about-edit',[
            'about'=>About::all()
        ]);
    }
    public function update(Request $request){
        $aboutData = [
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'description' => $request->description,
            'updated_at'=>Carbon::now()
        ];
        $about = About::find($request->id);
        if($request->image == ''){
            $about->update($aboutData);
        }
        else{
            if($about->image){
                if(file_exists('uploads/about/'.$about->image)){
                    unlink(public_path('uploads/about/'.$about->image));  
                }
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/about/'), $imageName);
            $aboutData['image'] = $imageName;
            $about->update($aboutData);
        }
        return back()->withSuccess('updated!');
    }
}
