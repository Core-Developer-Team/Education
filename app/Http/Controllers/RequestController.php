<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Feedback;
use App\Models\Offlinetopic;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\Reqbid;
use App\Models\ReqSolution;
use Illuminate\Http\Request;
use App\Models\Request as ModelsRequest;
use App\Models\Resource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
        $offline = Offlinetopic::count();
        $product = Product::count();
        $prop   = Proposal::count();
        return view('index', compact('datas', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
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
        $offline = Offlinetopic::count();
        $product = Product::count();
        $prop   = Proposal::count();
        return view('previousyearrequests', compact('datas', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
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
        $offline = Offlinetopic::count();
        $product = Product::count();
        $prop   = Proposal::count();
        return view('index', compact('datas', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
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
        $offline = Offlinetopic::count();
        $product = Product::count();
        $prop   = Proposal::count();
        return view('index', compact('datas', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }

    //store requests
    public function insert(Request $request)
    {

        $request->validate([
            'requestname'  => ['required', 'string'],
            'description'  => ['required', 'string'],
            'days'         => ['required'],
            'coursename'   => ['required', 'string'],
            'file'         => ['required', 'mimes:jpg,jpeg,svg,pdf,png'],
            'tag'          => ['required'],
            'price'          => ['required'],
        ]);

        $filename = time() . '_' . $request->file->getClientOriginalName();
        $imgPath = $request->file('file')->storeAs('ReqFile', $filename, 'public');
        ModelsRequest::create(array_merge($request->only('requestname', 'days', 'coursename', 'description', 'tag', 'price'), [
            'user_id' => auth()->id(),
            'file'    => '/storage/' . $imgPath,
            'filename' => $filename,
        ]));
        return redirect('/')->with('reqstatus', 'Your Request Published Successfully:)');
    }

    // Show single Request
    public function showsingle($id)
    {
        $data = ModelsRequest::find($id);
        //increase view count
        $req_key = 'req_' . $id;
        if (!Session::has($req_key)) {
            $data->increment('view_count');
            Session::put($req_key, 1);
        }
        return view('requestsingle', compact('data'));
    }
    //get all requests by a user
    public function getuserrequests()
    {

        $datas = ModelsRequest::where('user_id', Auth()->id())->orderBy('updated_at', 'DESC')->cursorPaginate(6);

        $req_count = ModelsRequest::count();
        $feed_count = Feedback::count();
        $mysol = ReqSolution::where('user_id', Auth()->id())->count();
        $myques = ModelsRequest::where('user_id', Auth()->id())->count();
        $res  = Resource::count();
        $event = Event::count();
        $offline = Offlinetopic::count();
        $product = Product::count();
        $prop   = Proposal::count();
        return view('myrequests', compact('datas', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
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
        $offline = Offlinetopic::count();
        $product = Product::count();
        $prop   = Proposal::count();
        return view('index', compact('datas', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
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
        $offline = Offlinetopic::count();
        $product = Product::count();
        $prop   = Proposal::count();
        return view('editrequest', compact('data', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //update request
    public function update(Request $request, $id)
    {
        $request->validate([
            'requestname'  => ['required', 'string'],
            'price'        => ['required'],
            'days'          =>  ['required'],
            'coursename'   => ['required', 'string'],
            'description'  => ['required', 'string'],
            'tag'          => ['required'],
        ]);
        $reqs = ModelsRequest::find($id);
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => ['required', 'mimes:jpg,jpeg,svg,pdf,png'],
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
    public function destroy($id)
    {
        $data = ModelsRequest::find($id);
        $file_path = public_path() . $data->file;
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        $data->delete();
        return back()->with('success', 'Request has deleted Successfully');
    }
}
