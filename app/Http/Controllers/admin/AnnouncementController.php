<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Reqbid;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $data = Announcement::all();
        return view('admin.announcement', compact('data'));
    }
    public function get()
    {
        return view('admin.addannouncement');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description'  => 'required|string',
            'active'       => 'required',
        ]);
        $announcement = new Announcement;
        $announcement->description = $request->description;
        $announcement->active = $request->active;
        $announcement->save();

        return redirect()->route('admin.announcement')->with('success', 'Announcement Posted Success');
    }
    public function updatestatus($id)
    {
        $announcement = Announcement::find($id);
        if ($announcement->active == 0) {
            $announcement->active = 1;
        } elseif ($announcement->active == 1) {
            $announcement->active = 0;
        }
        $announcement->save();
        return back()->with('success', 'Status updated Successfully');
    }
    public function destroy(Request $request)
    {
        $data = Announcement::find($request->announcement_id);
        $data->delete();
        return back()->with('success', 'Announcement has deleted Successfully');
    }
}
