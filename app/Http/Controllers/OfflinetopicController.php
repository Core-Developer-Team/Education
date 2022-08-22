<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offlinetopic;

class OfflinetopicController extends Controller
{
     //show offline topic page
   public function show(){
    $chats=Offlinetopic::orderBy('updated_at','DESC')->get();
  return view('offtopic', compact('chats'));
 }
 //get values
 public function get(Request $request){
       $request->validate([
           'group_chat_message' => ['required'],
       ]);
       Offlinetopic::create(array_merge($request->only('group_chat_message'),[
          'user_id' =>Auth()->id(),
          'status'  => '1',
      ]));
      return back();
 }
}
