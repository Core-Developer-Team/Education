<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Feedback;
use App\Models\Offlinetopic;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\Reqbid;
use App\Models\ReqSolution;
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
              'file'         => ['required','mimes:csv,txt,xlx,xls,pdf,docx,ppt,pptx,jpg,jpeg,png,svg','max:10000'],
              'description'  => ['required','string','max:255'],
              'request_id'   => ['unique:req_solutions,request_id,'.$request->request_id],
              'user_id'      => ['required'],
          ]);
        
           ReqSolution::create($request->only('file','description','request_id','user_id'));
           Reqbid::where('request_id', $request->request_id)->update([
               'status' => '1',
           ]);     
           User::where('id',$request->user_id)->increment('solutions',1);
           return back()->with('solstatus','Your Solution Published Successfully Wait for client action:)');  
      }

      //get my solution
       public function mysol()
       {
           $data = ReqSolution::where('user_id',Auth()->id())->get();
           $req_count = ModelsRequest::count();
           $feed_count = Feedback::count();
           $mysol = ReqSolution::where('user_id',Auth()->id())->count();
           $myques = ModelsRequest::where('user_id',Auth()->id())->count();
           $res  = Resource::count();
           $event = Event::count();
           $offline = Offlinetopic::count();
           $product = Product::count();
           $prop   = Proposal::count();
           return view('mysolutions',compact('data','req_count','feed_count','mysol','myques','res','event','offline','product','prop'));
       }

       //all solutions 
       public function allsolution()
       {
           $datas = ReqSolution::orderBy('created_at','DESC')->cursorPaginate(6);
           $bid = Reqbid::all();
           $req_count = ModelsRequest::count();
           $feed_count = Feedback::count();
           $mysol = ReqSolution::where('user_id',Auth()->id())->count();
           $myques = ModelsRequest::where('user_id',Auth()->id())->count();
           $res  = Resource::count();
           $event = Event::count();
           $offline = Offlinetopic::count();
           $product = Product::count();
           $prop   = Proposal::count();
           return view('allsolutions',compact('datas','bid','req_count','feed_count','mysol','myques','res','event','offline','product','prop'));
       }
}
