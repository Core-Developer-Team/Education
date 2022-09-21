<?php

namespace App\Http\Controllers;

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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ProposalController extends Controller
{
    //all proposals
    public function index()
    {
        $data = Proposal::orderBy('updated_at', 'DESC')->cursorPaginate(6);
        $categ = Proposal::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
        $bid = Proposalbid::all();
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

        $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
        $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
        $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
        $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();

        return view('devproposal', compact('data', 'categ', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'bid', 'prev_count', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //get latest request
    public function latesttutorial()
    {
        $data = Proposal::whereDate('created_at', Carbon::today())->orderBy('updated_at', 'DESC')->cursorPaginate(6);
        $categ = Proposal::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
        $bid = Proposalbid::all();
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

        $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
        $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
        $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
        $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();

        return view('devproposal', compact('data', 'categ', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'prev_count', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //get trending request
    public function trending()
    {
        $data = Proposal::where('view_count', '>=', 20)->orderBy('updated_at', 'DESC')->cursorPaginate(6);
        $categ = Proposal::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
        $bid = Proposalbid::all();
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

        $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
        $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
        $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
        $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();

        return view('devproposal', compact('data', 'categ', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'prev_count', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //get week request
    public function week()
    {
        $data = Proposal::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('updated_at', 'DESC')->cursorPaginate(6);
        $categ = Proposal::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
        $bid = Proposalbid::all();
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

        $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
        $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
        $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
        $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();

        return view('devproposal', compact('data', 'categ', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'prev_count', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    //add new proposal
    public function get(Request $request)
    {
        $request->validate([
            'proposalname'  => ['required', 'string'],
            'price'         => ['required', 'string'],
            'description'   => ['required', 'string'],
            'days'          => ['required'],
            'category'      => ['required', 'max:25'],
        ]);
        if ($request->hasFile('file')) {
            $request->validate([
                'file'         => ['required', 'mimes:jpg,jpeg,svg,pdf,png,zip,rar'],
            ]);
            $filename  = $request->file->getClientOriginalName();
            $filePath   =  $request->file('file')->storeAs('Images', $filename, 'public');
            Proposal::create(array_merge($request->only('proposalname', 'category','days', 'price', 'description'), [
                'user_id'  => auth()->id(),
                'file'     => '/storage/' . $filePath,
                'filename' => $filename,
            ]));
        } else {
            Proposal::create(array_merge($request->only('proposalname','category', 'days', 'price', 'description'), [
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
        return view('check', compact('data', 'user'));
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
        $categ = Proposal::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
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

        $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
        $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
        $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
        $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();

        return view('devproposal', compact('data', 'categ', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'bid', 'prev_count', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    public function searchcat($name)
    {
        $data =  Proposal::query()
            ->Where('category', 'LIKE', "%{$name}%")
            ->cursorPaginate(6);
        $bid = Proposalbid::all();
        $req_count = ModelsRequest::count();
        $categ = Proposal::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
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

        $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
        $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
        $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
        $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();

        return view('devproposal', compact('data', 'categ', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'bid', 'prev_count', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }

    public function proposalsingle($id)
    {
        $data = Proposal::find($id);
        $categ = Proposal::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
        $bid = Proposalbid::all();
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

        $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
        $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
        $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
        $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();

        return view('proposal_edit', compact('data', 'categ', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count', 'sol_count', 'bid', 'prev_count', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'proposalname'  => ['required', 'string'],
            'price'         => ['required', 'string'],
            'description'   => ['required', 'string'],
            'days'          => ['required'],
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
}
