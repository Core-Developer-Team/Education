<?php

namespace App\Http\Controllers;

use App\Models\Propsolution;
use Illuminate\Http\Request;
use App\Models\Reqbid;
use App\Models\ReqSolution;
use App\Models\Request as ModelsRequest;
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
            'days'        => ['required'],
            'user_id'     => ['required'],
        ]);
        Reqbid::create($request->only('price', 'description', 'days', 'request_id', 'user_id'));

        if (auth()->user()) {
            $req = ModelsRequest::where('id',$request->request_id)->first();
            $user = User::find(auth()->user()->id);
            $data = User::find($request->request_user);
            $data->notify(new BidNotification($user,$req));
        }

        return back()->with('bidstatus', 'Your Bid Published Successfully Wait for client action:)');
    }

    public function acceptbid(Request $request, $id){
        $updatebid = Reqbid::find($id);
        if($updatebid){
            $updatebid->reported = '1';
            $updatebid->save();
        }
        ReqSolution::where('request_id', $rid)->update([
            'status' => '1',
        ]);

        $request->session()->flash('success', 'Bid Accepted Successfully');
        return back();
    }
}
