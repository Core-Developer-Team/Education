<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reqbid;

class ReqbidController extends Controller
{
        //Request Bid Store
        public function store(Request $request)
        {
            $request->validate([
                'price'       => ['required','integer'],
                'description' => ['required','string','max:255'],
                'request_id'  => ['required'],
                'days'        => ['required','integer'],
                'user_id'     => ['required'],
            ]);
            Reqbid::create($request->only('price','description','days','request_id','user_id'));
             return back()->with('bidstatus','Your Bid Published Successfully Wait for client action:)');  
        }
}
