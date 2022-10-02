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
class RequestController extends Controller
{  
    
    
    // All requests page
    public function index()
    {
        $datas = ModelsRequest::orderBy('created_at', 'DESC')->cursorPaginate(6);
        $categ = ModelsRequest::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
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
        return view('index', compact('datas', 'sol_count','contest','prev_count', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    // All requests page
    public function previousyearQuestion()
    {
        $datas = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->cursorPaginate(6);
        $categ = ModelsRequest::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
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
        return view('previousyearrequests', compact('datas', 'sol_count','contest','prev_count', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //get latest request
    public function latest()
    {
        $datas = ModelsRequest::whereDate('created_at', Carbon::today())->orderBy('updated_at', 'DESC')->cursorPaginate(6);
        $bid = Reqbid::all();
        $categ = ModelsRequest::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
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
        return view('index', compact('datas', 'sol_count', 'prev_count','contest','t_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }

    //get week request
    public function weekly()
    {
        $datas = ModelsRequest::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('updated_at', 'DESC')->cursorPaginate(6);
        $bid = Reqbid::all();
        $categ = ModelsRequest::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
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
        return view('index', compact('datas', 'sol_count', 'prev_count','contest','t_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //get trending requests
    public function trending()
    {
        $datas = ModelsRequest::where('view_count', '>=', 20)->orderBy('updated_at', 'DESC')->cursorPaginate(6);
        $bid = Reqbid::all();
        $categ = ModelsRequest::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
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
        return view('index', compact('datas', 'sol_count', 'prev_count','contest','t_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
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
        $categ = ModelsRequest::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
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
        return view('index', compact('datas', 'sol_count', 'prev_count','contest','t_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //search cat
    public function searchcat($name)
    {
        $search = $name;
        $datas = ModelsRequest::query()
            ->Where('coursename', 'LIKE', "%{$search}%")
            ->cursorPaginate(6);
        $bid = Reqbid::all();
        $categ = ModelsRequest::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
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
        return view('index', compact('datas', 'sol_count', 'prev_count','contest','t_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
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
        $categ = ModelsRequest::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
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
        return view('index', compact('datas', 'sol_count', 'prev_count','contest','t_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
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
        return view('editrequest', compact('data',  't_req_count','contest','t_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'prev_count', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
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
        if($request->ajax())
        {
            $query = $request->get('query');
            if($query != '')
            {
                $datas = ModelsRequest::query()
                ->where('requestname', 'LIKE', "%{$query}%")
                ->orWhere('coursename', 'LIKE', "%{$query}%")
                ->cursorPaginate(6);
                return $datas;
                //return response()->json(['datas' => $datas]);
            }
            else
            {
                $datas = ModelsRequest::orderBy('created_at', 'DESC')->cursorPaginate(6);
                return $datas;
               // return response()->json(['datas' => $datas]);
            }
           
        }
    }

}
