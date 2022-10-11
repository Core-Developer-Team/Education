<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Reqsolutionreport;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function approveReport($id)
    {
        $data = Reqsolutionreport::find($id)->update(['status' => 1]);
        return redirect()->back()->with('message', 'Report approved successfully');
    }
}
