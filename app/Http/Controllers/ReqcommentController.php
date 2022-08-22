<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reqcomment;
class ReqcommentController extends Controller
{
    
    public function store(Request $request){
        $request->validate([
            'comment'  => ['required','string'],
        ]);
        Reqcomment::create(array_merge($request->only('comment'),[
            'user_id' =>Auth()->id(),
            'request_id'=>$request->request_id,
        ]));
        return back()->with('cstatus','Your Comment Published Successfully:)'); 
      
     }
}
