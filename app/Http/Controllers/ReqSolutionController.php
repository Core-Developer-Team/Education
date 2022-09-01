<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Feedback;
use App\Models\Offlinetopic;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\Reqbid;
use App\Models\ReqSolution;
use App\Models\Reqsolutionreport;
use App\Models\Request as ModelsRequest;
use App\Models\Resource;
use App\Models\User;
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
        Reqbid::where('request_id', $request->request_id)->update([
            'status' => '1',
        ]);
        User::where('id', $request->user_id)->increment('solutions', 1);

        $users = User::where('id', $request->user_id)->first();

        if ($users->solutions >= 20) {
            $users->badge_id = 2;
        } elseif ($users->solutions >= 70) {
            $users->badge_id = 3;
        } elseif ($users->solutions >= 80) {
            $users->badge_id = 4;
        } elseif ($users->solutions >= 100) {
            $users->badge_id = 5;
        }
        $users->update();

        return back()->with('solstatus', 'Your Solution Published Successfully Wait for client action:)');
    }

    //get my solution
    public function mysol()
    {
        $data = ReqSolution::where('user_id', Auth()->id())->get();
        $req_count = ModelsRequest::count();
        $feed_count = Feedback::count();
        $mysol = ReqSolution::where('user_id', Auth()->id())->count();
        $myques = ModelsRequest::where('user_id', Auth()->id())->count();
        $res  = Resource::count();
        $event = Event::count();
        $offline = Offlinetopic::count();
        $product = Product::count();
        $prop   = Proposal::count();
        $prev_count = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
        $sol_count = ReqSolution::orderBy('created_at', 'DESC')->count();
        return view('mysolutions', compact('data', 'sol_count', 'prev_count', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }

    //all solutions 
    public function allsolution()
    {
        $datas = ReqSolution::orderBy('created_at', 'DESC')->cursorPaginate(6);
        $bid = Reqbid::all();
        $req_count = ModelsRequest::count();
        $feed_count = Feedback::count();
        $mysol = ReqSolution::where('user_id', Auth()->id())->count();
        $myques = ModelsRequest::where('user_id', Auth()->id())->count();
        $res  = Resource::count();
        $event = Event::count();
        $offline = Offlinetopic::count();
        $product = Product::count();
        $prop   = Proposal::count();
        $prev_count = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
        $sol_count = ReqSolution::orderBy('created_at', 'DESC')->count();
        return view('allsolutions', compact('datas', 'sol_count', 'prev_count', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    public function solutionreport($uid,$rid,$sid)
    {
       Reqsolutionreport::Create([
        'user_id' => $uid,
        'request_id'  => $rid,
         'reqsolution_id' => $sid,
       ]);
      return back();
    }
}
