<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Commentreport;
use App\Models\Contest;
use App\Models\Event;
use App\Models\Feedback;
use App\Models\Offlinetopic;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\Propsolution;
use App\Models\Reqbid;
use App\Models\ReqSolution;
use Illuminate\Http\Request;
use App\Models\Request as ModelsRequest;
use App\Models\Resource;
use App\Models\Review;
use App\Models\User;
use App\Notifications\CommentNotification;
use App\Rules\GreaterThanCurrentTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{

    // All requests page
    public function index()
    {
        $datas = ModelsRequest::orderBy('created_at', 'DESC')->cursorPaginate(6);
        $categ = ModelsRequest::select('coursename')->distinct('coursename')->limit(15)->get();
        $bid = Reqbid::all();
        $req_count = ModelsRequest::count();
        $feed_count = Feedback::count();
        $mysol = ReqSolution::where('user_id', Auth()->id())->count();
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
        return view('index', compact('datas', 'sol_count', 'contest', 'prev_count', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    // All requests page
    public function previousyearQuestion()
    {
        $datas = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->cursorPaginate(6);
        $categ = ModelsRequest::select('coursename')->distinct('coursename')->limit(15)->get();
        $bid = Reqbid::all();
        $req_count = ModelsRequest::count();
        $feed_count = Feedback::count();
        $mysol = ReqSolution::where('user_id', Auth()->id())->count();
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
        return view('previousyearrequests', compact('datas', 'sol_count', 'contest', 'prev_count', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //get latest request
    public function latest()
    {
        $datas = ModelsRequest::whereDate('created_at', Carbon::today())->orderBy('updated_at', 'DESC')->cursorPaginate(6);
        $bid = Reqbid::all();
        $categ = ModelsRequest::select('coursename')->distinct('coursename')->limit(15)->get();
        $req_count = ModelsRequest::count();
        $feed_count = Feedback::count();
        $mysol = ReqSolution::where('user_id', Auth()->id())->count();
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
        return view('index', compact('datas', 'sol_count', 'prev_count', 'contest', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }

    //get week request
    public function weekly()
    {
        $datas = ModelsRequest::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('updated_at', 'DESC')->cursorPaginate(6);
        $bid = Reqbid::all();
        $categ = ModelsRequest::select('coursename')->distinct('coursename')->limit(15)->get();
        $req_count = ModelsRequest::count();
        $feed_count = Feedback::count();
        $mysol = ReqSolution::where('user_id', Auth()->id())->count();
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
        return view('index', compact('datas', 'sol_count', 'prev_count', 'contest', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //get trending requests
    public function trending()
    {
        $datas = ModelsRequest::where('view_count', '>=', 20)->orderBy('updated_at', 'DESC')->cursorPaginate(6);
        $bid = Reqbid::all();
        $categ = ModelsRequest::select('coursename')->distinct('coursename')->limit(15)->get();
        $req_count = ModelsRequest::count();
        $feed_count = Feedback::count();
        $mysol = ReqSolution::where('user_id', Auth()->id())->count();
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
        return view('index', compact('datas', 'sol_count', 'prev_count', 'contest', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //store requests
    public function insert(Request $request)
    {

        $request->validate([
            'requestname'  => ['required', 'string', 'max:25'],
            'description'  => ['required', 'string'],
            'days'         => ['required', 'date', new GreaterThanCurrentTime],
            'coursename'   => ['required', 'string'],
            'tag'          => ['required'],
            'price'          => ['required'],
        ]);

        if ($request->hasFile('file')) {
            $request->validate([
                'file'         => ['required', 'mimes:jpg,jpeg,svg,pdf,png,zip,rar'],
            ]);
            $filename = time() . '_' . $request->file->getClientOriginalName();
            $imgPath = $request->file('file')->storeAs('ReqFile', $filename, 'public');
            ModelsRequest::create(array_merge($request->only('requestname', 'days', 'coursename', 'description', 'tag', 'price'), [
                'user_id' => auth()->id(),
                'file'    => '/storage/' . $imgPath,
                'filename' => $filename,
            ]));
        } else {
            ModelsRequest::create(array_merge($request->only('requestname', 'days', 'coursename', 'description', 'tag', 'price'), [
                'user_id' => auth()->id(),
                'file'    => '',
                'filename' => '',
            ]));
        }

        return redirect('/')->with('reqstatus', 'Your Request Published Successfully:)');
    }

    // Show single Request
    public function showsingle($id)
    {
        $data = ModelsRequest::find($id);
        $reports = Commentreport::all();
        //increase view count
        $req_key = 'req_' . $id;
        if (!Session::has($req_key)) {
            $data->increment('view_count');
            Session::put($req_key, 1);
        }
        return view('requestsingle', compact('data', 'reports'));
    }
    //get all requests by a user
    public function getuserrequests()
    {

        $datas = ModelsRequest::where('user_id', Auth()->id())->orderBy('updated_at', 'DESC')->cursorPaginate(6);
        $bid = Reqbid::all();
        $categ = ModelsRequest::select('coursename')->distinct('coursename')->limit(15)->get();
        $req_count = ModelsRequest::count();
        $feed_count = Feedback::count();
        $mysol = ReqSolution::where('user_id', Auth()->id())->count();
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
        return view('index', compact('datas', 'sol_count', 'prev_count', 'contest', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //search cat
    public function searchcat($name)
    {
        $search = $name;
        $datas = ModelsRequest::query()
            ->Where('coursename', 'LIKE', "%{$search}%")
            ->cursorPaginate(6);
        $bid = Reqbid::all();
        $categ = ModelsRequest::select('coursename')->distinct('coursename')->limit(15)->get();
        $req_count = ModelsRequest::count();
        $feed_count = Feedback::count();
        $mysol = ReqSolution::where('user_id', Auth()->id())->count();
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
        return view('index', compact('datas', 'sol_count', 'prev_count', 'contest', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //search
    public function search(Request $request)
    {
        $request->validate([
            'search'  => ['required', 'string']
        ]);
        $search = $request->search;
        $datas = ModelsRequest::query()
            ->where('requestname', 'LIKE', "%{$search}%")
            ->orWhere('coursename', 'LIKE', "%{$search}%")
            ->cursorPaginate(6);
        $bid = Reqbid::all();
        $categ = ModelsRequest::select('coursename')->distinct('coursename')->limit(15)->get();
        $req_count = ModelsRequest::count();
        $feed_count = Feedback::count();
        $mysol = ReqSolution::where('user_id', Auth()->id())->count();
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
        return view('index', compact('datas', 'sol_count', 'prev_count', 'contest', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //show edit page
    public function show($id)
    {
        $data = ModelsRequest::find($id);
        $req_count = ModelsRequest::count();
        $feed_count = Feedback::count();
        $mysol = ReqSolution::where('user_id', Auth()->id())->count();
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
        return view('editrequest', compact('data',  't_req_count', 'contest', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'prev_count', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //update request
    public function update(Request $request, $id)
    {
        $request->validate([
            'requestname'  => ['required', 'string'],
            'price'        => ['required'],
            'days'         => ['required', 'date', new GreaterThanCurrentTime],
            'coursename'   => ['required', 'string'],
            'description'  => ['required', 'string'],
            'tag'          => ['required'],
        ]);
        $reqs = ModelsRequest::find($id);
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => ['required', 'mimes:jpg,jpeg,svg,pdf,png,zip,rar'],
            ]);
            $filename = time() . '_' . $request->file->getClientOriginalName();
            $imgPath = $request->file('file')->storeAs('ReqFile', $filename, 'public');
            $reqs->update(['file' => $imgPath]);
        }
        $reqs->update([
            'requestname' => $request->requestname,
            'price' => $request->price,
            'days' => $request->days,
            'coursename' => $request->coursename,
            'description' => $request->description,
            'tag' => $request->tag,
        ]);

        return redirect('/')->with('requpstatus', 'Your Request updated Successfully:)');
    }
    // Delete
    public function destroy(Request $request)
    {

        $data = ModelsRequest::find($request->req_id);
        $file_path = public_path() . $data->file;
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        $data->delete();
        return back()->with('success', 'Request has deleted Successfully');
    }

    function action(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            if ($query != '') {
                $datas = ModelsRequest::query()
                    ->where('requestname', 'LIKE', "%{$query}%")
                    ->orWhere('coursename', 'LIKE', "%{$query}%")
                    ->cursorPaginate(6);
                return $datas;
                //return response()->json(['datas' => $datas]);
            } else {
                $datas = ModelsRequest::orderBy('created_at', 'DESC')->cursorPaginate(6);
                return $datas;
                // return response()->json(['datas' => $datas]);
            }
        }
    }

    public function livesearch(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $time  = "";
            $see   = "";
            $datas = ModelsRequest::where('requestname', 'LIKE', '%' . $request->search . "%")->get();
            if ($datas) {
                foreach ($datas as $data) {

                    if (\Carbon\Carbon::parse(now())->diffInDays($data->days, false) <= 1) {
                        if (
                            \Carbon\Carbon::parse(now())->diffInMinutes($data->days, false) < 60 &&
                            \Carbon\Carbon::parse(now())->diffInMinutes($data->days, false) >= 1
                        ) {
                            $time =   \Carbon\Carbon::parse(now())->diffInMinutes($data->days, false) . " Minutes left";
                        } elseif (\Carbon\Carbon::parse(now())->diffInMinutes($data->days, false) <= 0) {
                            if (\Carbon\Carbon::parse(now())->diffInSeconds($data->days, false) > 0) {
                                $time = \Carbon\Carbon::parse(now())->diffInSeconds($data->days, false) . " Seconds left";
                            } else {
                                if ($data->reqsolution()->count() >= 1 && $data->reqsolution->request_id == $data->id) {
                                    $time = "Closed";
                                } else {
                                    $time = "Unsolved";
                                }
                            }
                        } else {
                            $time =  \Carbon\Carbon::parse(now())->diffInHours($data->days, false) . " Hours left";
                        }
                    } else {
                        $time = \Carbon\Carbon::parse(now())->diffInDays($data->days, false) . " days left";
                    }

                    if ($data->reqsolution()->count() > 0) {
                        foreach ($data->reqsolution  as $item) {
                            if ($item->request_id == $data->id) {
                                $see = "d-none";
                            }
                        }
                    }


                    $output .= ' 
                    <div class="full-width mt-4">
                    <div class="recent-items">
                        <div class="posts-list">
                            <div class="feed-shared-author-dt">
                                <div class="author-left userimg ">
                                    <img class="ft-plus-square job-bg-circle  bg-cyan mr-0" src="/storage/' . $data->user->image . '" alt="">
                                    <div style="position: relative;margin-top: -10px;margin-left: 10px;" class="presence-entity__badge ' . (Cache::has("user-is-online-" . $data->user_id) ? 'badge__online' : 'badge__offline') . '">
                                        <span class="visually-hidden">
                                            Status is online
                                        </span>
                                    </div>
                                    <!--hover on image-->
                                    <div class="box imagehov shadow" style="width: auto; height:auto;  position: absolute; z-index: 1;">
                                        <div class="full-width">
                                            <div class="recent-items">
                                                <div class="posts-list">
                                                    <div class="feed-shared-author-dt">
                                                        <div class="author-left">
                                                            <img class="ft-plus-square job-bg-circle bg-cyan" src="/storage/' . $data->user->image . '" alt="">
                                                            <div class="' . (Cache::has("user-is-online-" . $data->user->id) ? 'status-oncircle' : 'status-ofcircle') . '">
                                                            
                                                            </div>
                                                        </div>

                                                        <div class="author-dts">
                                                            <p class="notification-text font-username">
                                                                <a href="/profile_dashboard/' . $data->user_id . '" style="color:' . $data->user->role->color->name . '">' . $data->user->username . '
                                                                </a><img src="' . $data->user->badge->image . '" alt="" style="width: 20px;" title="' . $data->user->badge->name . '">
                                                                <span class="job-loca"><i class="fas fa-location-arrow"></i>' . $data->user->uni_name . '</span>
                                                            </p>

                                                            <p class="notification-text font-small-4 pt-1">
                                                                <span class="time-dt">Joined on ' . $data->user->created_at->format("d:M:y g:i A") . '</span>
                                                            </p>
                                                            <p class="notification-text font-small-4 pt-1">
                                                            <span class="time-dt">Last Seen ' . (Cache::has("user-is-online-" . $data->user->id) ? '<span class="text-success">Online</span>' : Carbon::parse($data->user->last_seen)->diffForHumans()) . ' </span>
                                                            </p>
                                                            <p class="notification-text font-small-4 pt-1">
                                                                <span class="time-dt">Total Solutions ' . $data->user->solutions . '</span>
                                                            </p>
                                                            <p class="notification-text font-small-4 pt-1">
                                                                <span class="time-dt">Rating ' . $data->user->rating . '</span>
                                                            </p>
                                                            <p class="notification-text font-small-4 pt-1">
                                                                <span class="time-dt">' . $data->user->badge->name . '</span>
                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end hover-->
                                </div>
                                <div class="iconreq">
                                    <img class="ft-plus-square job-bg-circle bg-cyan mr-0" src="' . $data->user->badge->image . '" style="width:20px; height:20px" title="' . $data->user->badge->name . '">
                                </div>
                                <div class="author-dts">
                                    <a href="/request_single/' . $data->id . '" class="problems_title">' . $data->requestname . '</a>
                                    <p class="notification-text font-username">
                                    </p><div class="userimg">
                                        <a href="/profile_dashboard/' . $data->user_id . '" class="" style="color: ' . $data->user->role->color->name . '">' . $data->user->username . '
                                            &nbsp;
                                        </a>
                                        <!--hover on image-->
                                        <div class="box imagehov shadow" style="width: auto; height:auto;  position: absolute; z-index: 1;">
                                        <div class="full-width">
                                            <div class="recent-items">
                                                <div class="posts-list">
                                                    <div class="feed-shared-author-dt">
                                                        <div class="author-left">
                                                            <img class="ft-plus-square job-bg-circle bg-cyan" src="/storage/' . $data->user->image . '" alt="">
                                                            <div class="' . (Cache::has("user-is-online-" . $data->user->id) ? 'status-oncircle' : 'status-ofcircle') . '">
                                                            </div>
                                                        </div>

                                                        <div class="author-dts">
                                                            <p class="notification-text font-username">
                                                                <a href="/profile_dashboard/' . $data->user_id . '" style="color:' . $data->user->role->color->name . '">' . $data->user->username . '
                                                                </a><img src="' . $data->user->badge->image . '" alt="" style="width: 20px;" title="' . $data->user->badge->name . '">
                                                                <span class="job-loca"><i class="fas fa-location-arrow"></i>' . $data->user->uni_name . '</span>
                                                            </p>

                                                            <p class="notification-text font-small-4 pt-1">
                                                                <span class="time-dt">Joined on ' . $data->user->created_at->format("d:M:y g:i A") . '</span>
                                                            </p>
                                                            <p class="notification-text font-small-4 pt-1">
                                                                <span class="time-dt">Last Seen ' . (Cache::has("user-is-online-" . $data->user->id) ? '<span class="text-success">Online</span>' : Carbon::parse($data->user->last_seen)->diffForHumans()) . ' </span>
                                                            </p>
                                                            <p class="notification-text font-small-4 pt-1">
                                                                <span class="time-dt">Total Solutions ' . $data->user->solutions . '</span>
                                                            </p>
                                                            <p class="notification-text font-small-4 pt-1">
                                                                <span class="time-dt">Rating ' . $data->user->rating . '</span>
                                                            </p>
                                                            <p class="notification-text font-small-4 pt-1">
                                                                <span class="time-dt">' . $data->user->badge->name . '</span>
                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <!-- end hover-->
                                    </div>
                                    <img src="' . ($data->user->badge_id == 5 || $data->user->status == 1 ? "/storage/badges/verified.svg" : "") . '" class=" ' . ($data->user->badge_id == 5 || $data->user->status == 1 ? " " : "d-none") . '" alt="Verified" style="width: 17px;" title="Verified">
                                    <span class="job-loca"><i class="fas fa-location-arrow"></i>' . $data->user->uni_name . '</span>
                                    <p></p>
                                    <span>' . $data->description . '</span>
                                    <p class="notification-text font-small-4 pt-1">
                                        <span class="time-dt">' . $data->created_at->diffForHumans() . '</span>
                                    </p>
                                    <div class="jbopdt142">
                                        <div class="jbbdges10">
                                            <span class="job-badge ffcolor"> ' . ($data->tag == 1 ? 'Offline' : 'Online') . ' </span>
                                            <span class="job-badge ddcolor">৳ ' . $data->price . ' </span>
                                            <span class="job-badge ttcolor"> ' . $time . ' </span>

                                        </div>
                                    </div>
                                </div>
                                <div class="ellipsis-options post-ellipsis-options dropdown dropdown-account">
                                    <a href="" class="label-dker post_categories_reported mr-10 ' . ($data->reqsolutionreport()->count() > 0 && $data->reqsolutionreport->proposal_id == $data->id ? '' : 'd-none') . '"><span class="label-dker post_categories_reported mr-10">Reported</span></a>
                                    <a href="" class="label-dker post_department_top_right mr-10 px-2"><span>' . $data->user->department->name . ' </span></a>
                                    <a href="" class="label-dker post_categories_top_right mr-20 ms-2"><span>' . $data->coursename . '</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="post-meta">
                            <div class="job-actions">
                                <div class="aplcnts_15">
                                    <i class="feather-users mr-2"></i><span>Applied</span><ins>' . $data->reqbid->count() . '</ins>
                                    <i class="feather-eye mr-2"></i><span>Views</span><ins>' . $data->view_count . '
                                    </ins>
                                </div>
                                <div class="action-btns-job d-flex justify-content-space">
                                    <a href="/request_single/' . $data->id . '" class="view-btn btn-hover">View Job</a>                                                                                              
                                </div>
                                ' . ($data->user_id == Auth()->id() ? '  
                                <div class="' . $see . '">
                                <a href="/edit/' . $data->id . '"
                                    title="Edit" class="px-3">
                                    <button type="button" class="bm-btn btn-hover">
                                        <i class="feather-edit"></i>
                                    </button>
                                </a>
                                <button class="bm-btn btn-hover delete-confirm"
                                    data-bs-toggle="modal" data-bs-target="#delreq"
                                    data-id="' . $data->id . '"><i
                                        class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>' : '') . '
                            </div>
                        </div>
                    </div>
                </div>';
                }

                return Response($output);
            }
        }
    }
}
