<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Feedback;
use App\Models\Offlinetopic;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\Proposalbid;
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
       public function index(){
        $data= Proposal::orderBy('updated_at','DESC')->cursorPaginate(6);
        $bid = Proposalbid::all();
        $req_count = ModelsRequest::count();
         $feed_count = Feedback::count();
         $mysol = ReqSolution::where('user_id',Auth()->id())->count();
         $myques = ModelsRequest::where('user_id',Auth()->id())->count();
         $res  = Resource::count();
         $event = Event::count();
         $offline = Offlinetopic::count();
         $product = Product::count();
         $prop   = Proposal::count();
        return view('devproposal',compact('data','bid','req_count','feed_count','mysol','myques','res','event','offline','product','prop'));
    }
           //get latest request
           public function latesttutorial(){
            $data=Proposal::whereDate('created_at', Carbon::today())->orderBy('updated_at','DESC')->cursorPaginate(6);
            $bid = Proposalbid::all();
            $req_count = ModelsRequest::count();
             $feed_count = Feedback::count();
             $mysol = ReqSolution::where('user_id',Auth()->id())->count();
             $myques = ModelsRequest::where('user_id',Auth()->id())->count();
             $res  = Resource::count();
             $event = Event::count();
             $offline = Offlinetopic::count();
             $product = Product::count();
             $prop   = Proposal::count();
            return view('devproposal',compact('data','bid','req_count','feed_count','mysol','myques','res','event','offline','product','prop'));    
          }
    
           //get week request
        public function week(){
            $data=Proposal::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->orderBy('updated_at','DESC')->cursorPaginate(6);
            $bid = Proposalbid::all();
            $req_count = ModelsRequest::count();
             $feed_count = Feedback::count();
             $mysol = ReqSolution::where('user_id',Auth()->id())->count();
             $myques = ModelsRequest::where('user_id',Auth()->id())->count();
             $res  = Resource::count();
             $event = Event::count();
             $offline = Offlinetopic::count();
             $product = Product::count();
             $prop   = Proposal::count();
            return view('devproposal',compact('data','bid','req_count','feed_count','mysol','myques','res','event','offline','product','prop'));  
          }
    //add new proposal
    public function get(Request $request)
    {
        $request->validate([
            'proposalname'  => ['required','string'],
            'price'         => ['required','string'],
            'description'   => ['required','string'],
            'file'          => ['required','mimes:jpg,jpeg,svg,pdf,png,jpeg'],
        ]);
        $filename  = $request->file->getClientOriginalName();
        $filePath   =  $request->file('file')->storeAs('Images',$filename,'public');
        Proposal::create(array_merge($request->only('proposalname','price','description'),[
            'user_id'  =>auth()->id(),
            'file'     =>'/storage/'.$filePath,
            'filename' => $filename,
        ]));
        return back()->with('status','Your Proposal Published Successfully:)');
    }
    //show single proposal
    public function showproposal($id)
    {
        $data = Proposal::find($id);
        $user = User::where('id',Auth()->id())->first();
         //increase view count
         $prop_key= 'prop_'.$id;
         if(!Session::has($prop_key)){
           $data->increment('view_count');
           Session::put($prop_key, 1);
         }
        return view('proposal_single',compact('data','user'));
    }
        //search 
        public function search(Request $request)
        {
           $request->validate([
               'search'  => ['required','string']
           ]);
           $search = $request->search;
           $data = Proposal::query()
           ->where('proposalname', 'LIKE', "%{$search}%")
           ->cursorPaginate(6);
           return view('devproposal',compact('data'));
        }
}
