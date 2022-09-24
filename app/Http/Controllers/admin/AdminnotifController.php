<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Moderator;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class AdminnotifController extends Controller
{
    public function index()
    {
        return view('admin.notifications');
    }
    public function allNotification()
    {
        $users = User::all();
        return view('admin.allnotifications',compact('users'));
    }
    public function destroy(Request $request)
    {
        $data=Notification::find($request->notification_id);
        $data->delete();
        return back()->with('success', 'Notification has deleted Successfully');
    }

    public function send($uid, $rid,$link)
    {
       Moderator::create([
        'user_id' => $uid,
        'request_id' => $rid,
        'link'    => $link,
        'mesg'    => 'Admin Assign you to check this Report',
       ]);
     return back()->with('status', 'Report assign Successfully');
    }

    public function moderator()
    {
        $moderators = Moderator::all();
        return view('admin.moderator',compact('moderators'));
    }
}
