<?php

namespace App\Http\Controllers;

use App\Models\Badge;
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
            'proposal_id'  => ['required'],
            'user_id'      => ['required'],
        ]);

        Propsolution::create($request->only('file', 'description', 'proposal_id', 'user_id'));
        //  Proposalbid::where('proposal_id', $request->proposal_id)->update([
        //    'status' => '1',
        // ]);
        User::where('id', $request->user_id)->increment('solutions', 1);

        $users = User::where('id', $request->user_id)->first();

        // getting Badges details

        $all_badges = Badge::all();
        foreach ($all_badges as $key => $badge) {
            $badge_name = $badge->name;
            switch ($badge_name) {
                case 'Medium level':
                    $medium_sol = $badge->solution;
                    $medium_rat = $badge->rating;
                    break;
                case 'Top rated':
                    $top_sol = $badge->solution;
                    $top_rat = $badge->rating;
                    break;
                case 'Verified':
                    $verified_sol = $badge->solution;
                    $verified_rat = $badge->rating;
                    break;
            }
        }

        if ($users->solutions >= $medium_sol && $users->solutions <= $top_sol) {
            $users->badge_id = 2;
        } elseif ($users->solutions > $top_sol && $users->solutions <= $verified_sol) {
            if ($users->rating >= $top_rat) {
                $users->badge_id = 3;
            } else {
                $users->badge_id = 2;
            }
        } elseif ($users->solutions > $verified_sol) {
            if ($users->rating >= $verified_rat) {
                $users->badge_id = 5;
            } else {
                $users->badge_id = 2;
            }
        }

        $findRequest = Proposal::find($request->proposal_id)->user_id;

        $deleteMessage = Message::whereIn('from_user_id', [$findRequest, $request->user_id])->whereIn('to_user_id', [$findRequest, $request->user_id])->delete();

        $users->update();

        if (auth()->user()) {
            $proposal = Proposal::where('id', $request->proposal_id)->first();
            $user = User::find(auth()->user()->id);
            $data = User::find($request->proposal_user);
            $data->notify(new PsolNotification($user, $proposal));
        }

        flash()->addSuccess('Your Solution Published Successfully:)');
        return back();
    }
    public function solutionreport(Request $request)
    {

        $request->validate([
            'message'  => ['required', 'string'],
        ]);

        Propsolreport::Create([
            'user_id' => $request->rep_user,
            'proposal_id'  => $request->repprop_id,
            'propsolution_id' => $request->repsol_id,
            'message'    => $request->message,
        ]);

        if (auth()->user()) {
            $req = Proposal::where('id', $request->repprop_id)->first();
            $user = User::find(auth()->user()->id);
            $touser = User::find($request->rep_user);
            $remesg = $request->message;
            $data = User::find(1);
            $data->notify(new PsolreportNotification($user, $req, $touser, $remesg));
        }
        flash()->addSuccess('Report Send Successfully:)');
        return back();
    }
}
