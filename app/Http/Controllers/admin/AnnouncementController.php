<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::orderBy('updated_at', 'DESC')->get();
        return view('admin/announcement', compact('announcements'));
    }
    public function get()
    {
        return view('admin/addannouncement');
    }
    public function store(Request $request)
    {
        $request->validate([
            'description'  => 'required|string',
            'status'        => 'required',
        ]);
        $announcement = new Announcement();
        $announcement->description = $request->description;
        $announcement->active = $request->status;
        $announcement->save();

        return redirect()->route('admin.announcement')->with('status', 'Announcement Posted Success');
    }
    public function updatestatus($id)
    {
        $data = Announcement::find($id);
        if ($data->active == 1) {
            $data->active = 0;
        } elseif ($data->active == 0) {
            $data->active = 1;
        }
        $data->update();
        return back()->with('status', 'Announcement Update Success');
    }
    public function destroy($id)
    {
        $data=Announcement::find($id);
       $data->delete();
       return back()->with('status', 'Announcement has deleted Successfully');
    }
}