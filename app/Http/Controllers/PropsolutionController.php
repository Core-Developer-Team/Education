<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Proposal;
use App\Models\Proposalbid;
use App\Models\Propsolreport;
use App\Models\Propsolution;
use App\Models\User;
use App\Notifications\PsolNotification;
use App\Notifications\PsolreportNotification;
use Illuminate\Http\Request;

class PropsolutionController extends Controller
{
    //prop solution Store
    public function store(Request $request)
    {

        $request->validate([
            'file'         => ['required', 'mimes:csv,txt,xlx,xls,pdf,docx,ppt,,zip,rar,pptx,jpg,jpeg,png,svg', 'max:10000'],
            'description'  => ['required', 'string', 'max:255'],
            'proposal_id'  => ['unique:propsolutions,proposal_id,' . $request->proposal_id],
            'user_id'      => ['required'],
        ]);

        Propsolution::create($request->only('file', 'description', 'proposal_id', 'user_id'));
        Proposalbid::where('proposal_id', $request->proposal_id)->update([
            'status' => '1',
        ]);
        User::where('id', $request->user_id)->increment('solutions', 1);

        $users = User::where('id', $request->user_id)->first();

        if ($users->solutions >= 20 && $users->solutions<=70) {
            $users->badge_id = 2;
        } elseif ($users->solutions > 70 && $users->solutions <= 80 && $users->rating>=4.7 ) {
            $users->badge_id = 3;
        } elseif ($users->solutions > 80 && $users->solutions <= 100 && $users->rating>=4.0) {
            $users->badge_id = 4;
        } elseif ($users->solutions > 100 && $users->rating>=4.0) {
            $users->badge_id = 5;
        }

        $findRequest = Proposal::find($request->proposal_id)->user_id;

        $deleteMessage = Message::whereIn('from_user_id', [$findRequest, $request->user_id])->whereIn('to_user_id', [$findRequest, $request->user_id])->delete();

        $users->update();

        if (auth()->user()) {
            $proposal = Proposal::where('id',$request->proposal_id)->first();
            $user = User::find(auth()->user()->id);
            $data = User::find($request->proposal_user);
            $data->notify(new PsolNotification($user, $proposal));
        }

        return back()->with('solstatus', 'Your Solution Published Successfully Wait for client action:)');
    }
    public function solutionreport($uid, $rid, $sid)
    {
        Propsolreport::Create([
            'user_id' => $uid,
            'proposal_id'  => $rid,
            'propsolution_id' => $sid,
        ]);
        if (auth()->user()) {
            $req = Proposal::where('id', $rid)->first();
            $user = User::find(auth()->user()->id);
            $touser = User::find($uid);
            $data = User::find(1);
            $data->notify(new PsolreportNotification($user, $req, $touser));
        }
        return back();
    }
}
