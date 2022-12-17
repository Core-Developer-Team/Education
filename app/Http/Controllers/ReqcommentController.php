<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reqcomment;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use App\Notifications\CommentNotification;

class ReqcommentController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'comment'  => ['required', 'string'],
        ]);
        Reqcomment::create(array_merge($request->only('comment'), [
            'user_id' => Auth()->id(),
            'request_id' => $request->request_id,
        ]));

        if (auth()->user()) {
            $req = ModelsRequest::where('id', $request->request_id)->first();
            $user = User::find(auth()->user()->id);
            $data = User::find($request->request_user);
            $data->notify(new CommentNotification($user, $req));
        }
        flash()->addSuccess('Your Comment Published Successfully');
        return back();
    }
}
