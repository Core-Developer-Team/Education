<?php

namespace App\Http\Controllers;

use App\Models\Resourcebid;
use Illuminate\Http\Request;

class ResourcebidController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'price'       => ['required','integer'],
            'description' => ['required','string','max:255'],
            'resource_id'  => ['required'],

        ]);
        Resourcebid::create(array_merge($request->only('resource_id','price','description'),[
            'user_id'  => auth()->id(),
        ]));
        return back()->with('status','Your Bit Published Successfully:)');
    }
}
