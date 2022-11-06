<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Reqsolutionreport;
use App\Models\Propsolreport;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function approveReport($id)
    {
        if (isset($_GET["type"])) {
            if ($_GET["type"] == "proposal") {
                $data =  Propsolreport::find($id)->update(['status' => 1]);
                return redirect()->back()->with('message', 'Report approved successfully');
            }
        }
        $data = Reqsolutionreport::find($id)->update(['status' => 1]);
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
