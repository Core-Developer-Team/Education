<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Proposalbid;
use App\Models\Reqsolutionreport;
use App\Models\Propsolreport;
use App\Models\Propsolution;
use App\Models\Reqbid;
use App\Models\ReqSolution;
use App\Models\User;
use App\Notifications\ReqrepApproved;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function approveReport($id, $rid)
    {
        if (isset($_GET["type"])) {
            if ($_GET["type"] == "proposal") {
                $prop =  Propsolreport::find($id)->first();
                $data =  Propsolreport::find($id)->update(['status' => 1]);
                Proposalbid::where('proposal_id', $rid)->update([
                    'status' => '1',
                ]);

                if(auth()->user()){
                    $usr = User::find(auth()->user()->id);
                    $tuser = User::find($prop->user_id);
                    $tuser->notify(new ReqrepApproved($usr, $prop , $tuser));
                }

                return redirect()->back()->with('message', 'Report approved successfully');
            }
        }


        $req = Reqsolutionreport::find($id)->first();
        $data = Reqsolutionreport::find($id)->update(['status' => 1]);
        Reqbid::where('request_id', $rid)->update([
            'status' => '1',
        ]);
        if(auth()->user()){
            $usr = User::find(auth()->user()->id);
            $tuser = User::find($req->user_id);
            $tuser->notify(new ReqrepApproved($usr, $req , $tuser));
        }
        return redirect()->back()->with('message', 'Report approved successfully');
    }

    public function rejectReport($id)
    {
        if (isset($_GET["type"])) {
            if ($_GET["type"] == "proposal") {
                $data =  Propsolreport::find($id)->update(['status' => 2]);
                return redirect()->back()->with('message', 'Report approved successfully');
            }
        }
        $data = Reqsolutionreport::find($id)->update(['status' => 2]);
        return redirect()->back()->with('message', 'Report rejected successfully');
    }
}
