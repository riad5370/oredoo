<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inbox;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function inbox(){
       return view('admin.mail.inbox',[
        'inboxes'=>Inbox::all()
       ]);
    }
    public function show($id){
        $message = Inbox::find($id);
        $message->status = 1;
        $message->save();
        return view('admin.mail.show-massage',[
            'message'=>$message
        ]);
    }
    public function destroy($inbox){
       Inbox::find($inbox)->delete();
       return back()->withSuccess('delete successfull!'); 
    }
}
