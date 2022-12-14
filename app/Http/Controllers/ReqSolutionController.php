<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Contest;
use App\Models\Event;
use App\Models\Feedback;
use App\Models\Message;
use App\Models\Offlinetopic;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\Propsolution;
use App\Models\Reqbid;
use App\Models\ReqSolution;
use App\Models\Reqsolutionreport;
use App\Models\Request as ModelsRequest;
use App\Models\Resource;
use App\Models\User;
use App\Notifications\Reporteduser;
use App\Notifications\SolNotification;
use App\Notifications\SolreportNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReqSolutionController extends Controller
{
    //Request solution Store
    public function store(Request $request)
    {

        $request->validate([
            'file'         => ['required', 'mimes:csv,txt,xlx,xls,pdf,docx,ppt,pptx,jpg,jpeg,png,svg,zip,rar', 'max:10000'],
            'description'  => ['required', 'string', 'max:255'],
            'request_id'   => ['required'],
            'user_id'      => ['required'],
        ]);
        $filename = time() . '_' . $request->file->getClientOriginalName();
        $imgPath = $request->file('file')->storeAs('ReqFile', $filename, 'public');
        ReqSolution::create(array_merge($request->only('user_id', 'request_id', 'description'), [
            'file'    => '/storage/' . $imgPath,
        ]));

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

        $findRequest = ModelsRequest::find($request->request_id)->user_id;

        $deleteMessage = Message::whereIn('from_user_id', [$findRequest, $request->user_id])->whereIn('to_user_id', [$findRequest, $request->user_id])->delete();

        $users->update();

        if (auth()->user()) {
            $req = ModelsRequest::where('id', $request->request_id)->first();
            $user = User::find(auth()->user()->id);
            $data = User::find($request->request_user);
            $data->notify(new SolNotification($user, $req));
        }
        flash()->addSuccess('Solution Published Successfully');
        return back();
    }

    //get my solution
    public function mysol()
    {
        $data = ReqSolution::where('user_id', Auth()->id())->get();
        $propsoldata = Propsolution::where('user_id', Auth()->id())->get();
        $req_count = ModelsRequest::count();
        $feed_count = Feedback::count();
        $mysol = ReqSolution::where('user_id', Auth()->id())->count();
        $mypropsol = Propsolution::where('user_id', Auth()->id())->count();
        $myques = ModelsRequest::where('user_id', Auth()->id())->count();
        $res  = Resource::count();
        $event = Event::count();
        $contest = Contest::count();
        $offline = Offlinetopic::count();
        $product = Product::count();
        $prop   = Proposal::count();
        $prev_count = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
        $sol_count = ReqSolution::orderBy('created_at', 'DESC')->count();

        $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
        $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
        $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
        $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();

        return view('mysolutions', compact('data', 'mypropsol', 'propsoldata', 'contest', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'prev_count', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }

    //all solutions
    public function allsolution()
    {
        $datas = ReqSolution::orderBy('created_at', 'DESC')->cursorPaginate(6);
        $bid = Reqbid::all();
        $req_count = ModelsRequest::count();
        $feed_count = Feedback::count();
        $mysol = ReqSolution::where('user_id', Auth()->id())->count();
        $mypropsol = Propsolution::where('user_id', Auth()->id())->count();
        $myques = ModelsRequest::where('user_id', Auth()->id())->count();
        $res  = Resource::count();
        $event = Event::count();
        $contest = Contest::count();
        $offline = Offlinetopic::count();
        $product = Product::count();
        $prop   = Proposal::count();
        $prev_count = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
        $sol_count = ReqSolution::orderBy('created_at', 'DESC')->count();

        $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
        $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
        $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
        $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();


        return view('allsolutions', compact('datas', 'mypropsol', 'contest', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'prev_count', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    public function solutionreport(Request $request)
    {
        $request->validate([
            'message'  => ['required', 'string'],
        ]);

        Reqsolutionreport::Create([
            'user_id' => $request->rep_user,
            'request_id'  => $request->repprop_id,
            'req_solution_id' => $request->repsol_id,
            'message'    => $request->message,
        ]);
        if (auth()->user()) {
            $req = ModelsRequest::where('id', $request->repprop_id)->first();
            $user = User::find(auth()->user()->id);
            $touser = User::find($request->rep_user);
            $remesg = $request->message;
            $data = User::find(1);
            $data->notify(new SolreportNotification($user, $remesg, $req, $touser));
        }
        if (auth()->user()) {
            $usr = User::find(auth()->user()->id);
            $tuser = User::find($request->rep_user);
            $tuser->notify(new Reporteduser($usr, $req, $tuser));
        }
        flash()->addSuccess('Report Send Successfully');
        return back();
    }
    //All Reported Solution
    public function Allrepsolution()
    {
        $datas = Reqsolutionreport::all();
        $bid = Reqbid::all();
        $req_count = ModelsRequest::count();
        $feed_count = Feedback::count();
        $mysol = ReqSolution::where('user_id', Auth()->id())->count();
        $mypropsol = Propsolution::where('user_id', Auth()->id())->count();
        $myques = ModelsRequest::where('user_id', Auth()->id())->count();
        $res  = Resource::count();
        $event = Event::count();
        $contest = Contest::count();
        $offline = Offlinetopic::count();
        $product = Product::count();
        $prop   = Proposal::count();
        $prev_count = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
        $sol_count = ReqSolution::orderBy('created_at', 'DESC')->count();

        $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
        $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
        $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
        $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();

        return view('reportedsolutions', compact('datas', 'mypropsol', 'contest', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'prev_count', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
}
