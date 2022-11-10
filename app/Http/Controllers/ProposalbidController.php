<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\Proposalbid;
use App\Models\Propsolution;
use App\Models\User;
use App\Notifications\PbidNotification;

class ProposalbidController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'price'       => ['required','integer'],
            'description' => ['required','string','max:255'],
            'days'        => ['required'],
            'proposal_id'  => ['required'],

        ]);
        Proposalbid::create(array_merge($request->only('proposal_id','days','price','description'),[
            'user_id'  => auth()->id(),
        ]));

        if (auth()->user()) {
            $proposal = Proposal::where('id',$request->proposal_id)->first();
            $user = User::find(auth()->user()->id);
            $data = User::find($request->proposal_user);
            $data->notify(new PbidNotification($user,$proposal));
        }

        return back()->with('status','Your Bit Published Successfully:)');
    }
    public function acceptbid(Request $request, $id, $rid){
        $updatebid = Proposalbid::find($id);
        if($updatebid){
            $updatebid->reported = '1';
            $updatebid->save();
        }
        Propsolution::where('proposal_id', $rid)->update([
            'status' => '1',
        ]);

        $request->session()->flash('success', 'Bid Accepted Successfully');
        return back();
    }
}
