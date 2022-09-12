<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reqbid;
use App\Models\User;
use App\Notifications\BidNotification;

class ReqbidController extends Controller
{
    //Request Bid Store
    public function store(Request $request)
    {
        $request->validate([
            'price'       => ['required', 'integer'],
            'description' => ['required', 'string', 'max:255'],
            'request_id'  => ['required'],
            'days'        => ['required', 'integer'],
            'user_id'     => ['required'],
        ]);
        Reqbid::create($request->only('price', 'description', 'days', 'request_id', 'user_id'));

        if (auth()->user()) {
            $user = User::find(auth()->user()->id);
            $data = User::find($request->request_user);
            $data->notify(new BidNotification($user));
        }

        return back()->with('bidstatus', 'Your Bid Published Successfully Wait for client action:)');
    }
}
