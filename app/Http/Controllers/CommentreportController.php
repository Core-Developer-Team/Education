<?php

namespace App\Http\Controllers;

use App\Models\Commentreport;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use App\Notifications\ComreportNotification;
use Illuminate\Http\Request;

class CommentreportController extends Controller
{
    public function get(Request $request, $uid,$cid)
    {
        Commentreport::Create([
           'user_id' => $uid,
           'reqcomment_id' => $cid,
        ]);

        if (auth()->user()) {
            $req = ModelsRequest::where('id', $request->request_id)->first();
            $user = User::find(auth()->user()->id);
            $touser = User::find($uid);
            $data = User::find(1);
            $data->notify(new ComreportNotification($user, $req, $touser));
        }
      
        return back()->with('success', 'Report send Successfully');
    }
}
