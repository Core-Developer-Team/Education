<?php

namespace App\Http\Controllers;

use App\Models\Proposalbid;
use App\Models\Propsolution;
use App\Models\User;
use Illuminate\Http\Request;

class PropsolutionController extends Controller
{
      //Request solution Store
      public function store(Request $request)
      {
        
          $request->validate([
              'file'         => ['required','mimes:csv,txt,xlx,xls,pdf,docx,ppt,pptx,jpg,jpeg,png,svg','max:10000'],
              'description' => ['required','string','max:255'],
              'proposal_id'   => ['required'],
              'user_id'      => ['required'],
          ]);
        
           Propsolution::create($request->only('file','description','proposal_id','user_id'));
           Proposalbid::where('proposal_id', $request->proposal_id)->update([
               'status' => '1',
           ]);     
           User::where('id',$request->user_id)->increment('solutions',1);
           return back()->with('solstatus','Your Solution Published Successfully Wait for client action:)');  
      }

}
