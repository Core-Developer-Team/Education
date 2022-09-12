<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposalbid;
use App\Models\User;
use App\Notifications\PbidNotification;

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

        if (auth()->user()) {
            $user = User::find(auth()->user()->id);
            $data = User::find($request->proposal_user);
            $data->notify(new PbidNotification($user));
        }

        return back()->with('status','Your Bit Published Successfully:)');
    }
}
