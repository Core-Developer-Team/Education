<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposalbid;
class ProposalbidController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'price'       => ['required','integer'],
            'description' => ['required','string','max:255'],
            'days'        => ['required','integer'],
            'proposal_id'  => ['required'],

        ]);
        Proposalbid::create(array_merge($request->only('proposal_id','days','price','description'),[
            'user_id'  => auth()->id(),
        ]));
        return back()->with('status','Your Bit Published Successfully:)');
    }
}
