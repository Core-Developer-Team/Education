<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Event;
use App\Models\Feedback;
use App\Models\Offlinetopic;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\Proposalbid;
use App\Models\Propsolution;
use App\Models\ReqSolution;
use App\Models\Request as ModelsRequest;
use App\Models\Resource;
use App\Models\User;
use App\Rules\GreaterThanCurrentTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class ProposalController extends Controller
{
    //all proposals
    public function index()
    {
        $data = Proposal::orderBy('updated_at', 'DESC')->cursorPaginate(6);
        $categ = DB::table('proposals')->distinct('category')->limit(15)->groupBy('id')->get('category');
        $bid = Proposalbid::all();
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

        return view('devproposal', compact('data', 'categ', 'contest', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'bid', 'prev_count', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //get latest request
    public function latesttutorial()
    {
        $data = Proposal::whereDate('created_at', Carbon::today())->orderBy('updated_at', 'DESC')->cursorPaginate(6);
        $categ = DB::table('proposals')->distinct('category')->limit(15)->groupBy('id')->get('category');
        $bid = Proposalbid::all();
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

        return view('devproposal', compact('data', 'contest', 'categ', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'prev_count', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //get trending request
    public function trending()
    {
        $data = Proposal::where('view_count', '>=', 20)->orderBy('updated_at', 'DESC')->cursorPaginate(6);
        $categ = DB::table('proposals')->distinct('category')->limit(15)->groupBy('id')->get('category');
        $bid = Proposalbid::all();
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

        return view('devproposal', compact('data', 'categ', 'contest', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'prev_count', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //get week request
    public function week()
    {
        $data = Proposal::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('updated_at', 'DESC')->cursorPaginate(6);
        $categ = DB::table('proposals')->distinct('category')->limit(15)->groupBy('id')->get('category');
        $bid = Proposalbid::all();
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

        return view('devproposal', compact('data', 'categ', 'contest', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'prev_count', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //add new proposal
    public function get(Request $request)
    {
        $request->validate([
            'proposalname'  => ['required', 'string'],
            'price'         => ['required', 'string'],
            'description'   => ['required', 'string'],
            'days'          => ['required', 'date', new GreaterThanCurrentTime],
            'category'      => ['required', 'max:25'],
        ]);
        if ($request->hasFile('file')) {
            $request->validate([
                'file'         => ['required', 'mimes:jpg,jpeg,svg,pdf,png,zip,rar'],
            ]);
            $filename  = $request->file->getClientOriginalName();
            $filePath   =  $request->file('file')->storeAs('Images', $filename, 'public');
            Proposal::create(array_merge($request->only('proposalname', 'category', 'days', 'price', 'description'), [
                'user_id'  => auth()->id(),
                'file'     => '/storage/' . $filePath,
                'filename' => $filename,
            ]));
        } else {
            Proposal::create(array_merge($request->only('proposalname', 'category', 'days', 'price', 'description'), [
                'user_id'  => auth()->id(),
                'file'     => '',
                'filename' => '',
            ]));
        }

        return back()->with('status', 'Your Proposal Published Successfully:)');
    }
    //show single proposal
    public function showproposal($id)
    {
        $data = Proposal::find($id);
        $user = User::where('id', Auth()->id())->first();
        //increase view count
        $prop_key = 'prop_' . $id;
        if (!Session::has($prop_key)) {
            $data->increment('view_count');
            Session::put($prop_key, 1);
        }
        return view('proposal_single', compact('data', 'user'));
    }
    //search
    public function search(Request $request)
    {
        $request->validate([
            'search'  => ['required', 'string']
        ]);
        $search = $request->search;
        $data = Proposal::query()
            ->where('proposalname', 'LIKE', "%{$search}%")
            ->cursorPaginate(6);
        $bid = Proposalbid::all();
        $categ = DB::table('proposals')->distinct('category')->limit(15)->groupBy('id')->get('category');
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

        return view('devproposal', compact('data', 'contest', 'categ', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'bid', 'prev_count', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    public function searchcat($name)
    {
        $data =  Proposal::query()
            ->Where('category', 'LIKE', "%{$name}%")
            ->cursorPaginate(6);
        $bid = Proposalbid::all();
        $req_count = ModelsRequest::count();
        $categ = DB::table('proposals')->distinct('category')->limit(15)->groupBy('id')->get('category');
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

        return view('devproposal', compact('data', 'contest', 'categ', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'bid', 'prev_count', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }

    public function proposalsingle($id)
    {
        $data = Proposal::find($id);
        $categ = DB::table('proposals')->distinct('category')->limit(15)->groupBy('id')->get('category');
        $bid = Proposalbid::all();
        $req_count = ModelsRequest::count();
        $feed_count = Feedback::count();
        $mysol = ReqSolution::where('user_id', Auth()->id())->count();
        $myques = ModelsRequest::where('user_id', Auth()->id())->count();
        $res  = Resource::count();
        $event = Event::count();
        $contest = Contest::count();
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

        return view('proposal_edit', compact('data', 'contest', 'categ', 'contest', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'bid', 'prev_count', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'proposalname'  => ['required', 'string'],
            'price'         => ['required', 'string'],
            'description'   => ['required', 'string'],
            'days'          => ['required', 'date', new GreaterThanCurrentTime],
            'category'      => ['required', 'max:25'],
        ]);

        $proposal = Proposal::find($request->proposal_id);

        if ($request->hasFile('file')) {

            $request->validate([
                'file'         => ['required', 'mimes:jpg,jpeg,svg,pdf,png,zip,rar'],
            ]);
            $filename  = $request->file->getClientOriginalName();
            $filePath   =  $request->file('file')->storeAs('Images', $filename, 'public');
            $proposal->update(['file' => $filePath]);
            $proposal->update(['filename' => $filename]);
        }
        $proposal->update([
            'proposalname' => $request->proposalname,
            'price' => $request->price,
            'days' => $request->days,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return back()->with('status', 'Your Proposal Updated Successfully:)');
    }
    public function livesearch(Request $request)
    {
        if ($request->ajax()) {
            $output = "";

            $datas = Proposal::where('proposalname', 'LIKE', '%' . $request->search . "%")->get();
            if ($datas) {
                foreach ($datas as $data) {
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
                                    <a href="/proposal_single/' . $data->id . '" class="problems_title">' . $data->proposalname . '</a>
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
                                            <span class="job-badge ddcolor">৳ ' . $data->price . ' </span>
                                            <span class="job-badge ttcolor"> 2 days ago </span>

                                        </div>
                                    </div>
                                </div>
                                <div class="ellipsis-options post-ellipsis-options dropdown dropdown-account">
                                    <a href="" class="label-dker post_categories_reported mr-10 ' . ($data->propsolreport()->count() > 0 && $data->propsolreport->proposal_id == $data->id ? '' : 'd-none') . '"><span class="label-dker post_categories_reported mr-10">Reported</span></a>
                                    <a href="" class="label-dker post_department_top_right mr-10 px-2"><span>' . ($data->user->department == 0 ? 'bba' : ($data->user->department == 1 ? 'bse' : 'bcs')) . ' </span></a>
                                    <a href="" class="label-dker post_categories_top_right mr-20 ms-2"><span>' . $data->category . '</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="post-meta">
                            <div class="job-actions">
                                <div class="aplcnts_15">
                                    <i class="feather-users mr-2"></i><span>Applied</span><ins>' . $data->proposalbid()->count() . '</ins>
                                    <i class="feather-eye mr-2"></i><span>Views</span><ins>' . $data->view_count . '
                                    </ins>
                                </div>
                                <div class="action-btns-job d-flex justify-content-space">
                                    <a href="/proposal_single/' . $data->id . '" class="view-btn btn-hover">View Job</a>                                                                                              
                                </div>
                                ' . ($data->user_id == Auth()->id() ? '  <div class="">
                                <a href="/proposal_edit/' . $data->id . '"
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
