<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index($req_id, $to_id){
       $fuser=Auth()->id();
       $to_user = User::find($to_id);
       $from_user = User::find($fuser);
       return view('messages',compact('to_user','from_user'));
    }
    public function store(Request $request){
        $request->validate([
            'content' => ['required'],
        ]);
        Message::create(array_merge($request->only('content'),[
            'from_user_id' =>Auth()->id(),
            'to_user_id'  => $request->to_user_id,
            'message_id' =>5,
        ]));
       $data = Message::where('from_user_id', Auth()->id() AND 'to_user_id',$request->to_user_id)->orWhere('from_user_id',$request->to_user_id AND 'to_user_id',Auth()->id())->get();
     
        return view('messages',compact('data'));
    }
}
