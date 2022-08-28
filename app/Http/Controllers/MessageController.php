<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index($req_id, $to_id)
    {
        $fuser = Auth()->id();
        $to_user = User::find($to_id);
        $from_user = User::find($fuser);
        return view('messages', compact('to_user', 'from_user'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required'],
        ]);
        Message::create(array_merge($request->only('content'), [
            'from_user_id' => Auth()->id(),
            'to_user_id'  => $request->to_user_id,
            'message_id' => 5,
        ]));
        $data = Message::where('from_user_id', Auth()->id() and 'to_user_id', $request->to_user_id)->orWhere('from_user_id', $request->to_user_id and 'to_user_id', Auth()->id())->get();

        return view('messages', compact('data'));
    }

    public function messages(Request $request)
    {
        $data = [];
        $data['toId'] = @$request->to_id;
        $userId = Auth()->id();
        $mymessaghwith = Message::Where('to_user_id', $userId)->orWhere('from_user_id', $userId)->get();
        $usersWithMe = [];
        $i = 0;
        foreach ($mymessaghwith as $key => $value) {
            if ($userId != $value->to_user_id) {
                $usersWithMe[$i] = $value->to_user_id;
            }
            if ($userId != $value->from_user_id) {
                $i++;
                $usersWithMe[] = $value->from_user_id;
            }
        }
        // dd($usersWithMe);
        $myUsers = array_unique($usersWithMe);
        $dropdownHtml = '';

        if (isset($request->to_id)) :
            // check is first time
            $ifPrevious = Message::whereIn('from_user_id', [$userId, $request->to_id])->whereIn('to_user_id',  [$userId, $request->to_id])->orderBy('created_at')->get();
            $data["messages-with"] = $ifPrevious;
            // dd(count($ifPrevious));
            if ($ifPrevious->count() == 0) {
                $findData =  User::find($request->to_id);
                $dropdownHtml .= view('chat-sidebar-data', compact('findData','toId'))->render();
            }
            $data["userDetails"] = User::find($request->to_id);
        endif;

        if (count($myUsers) > 0) {
            foreach ($myUsers as $key => $value) {
                if ($value != $userId) {
                    $findData = User::find($value);
                    if ($findData) {
                        $dropdownHtml .= view('chat-sidebar-data', compact('findData'))->render();
                    }
                }
            }
        }



        $data['friends'] = $dropdownHtml;

        return view('messages', $data);
    }

    public function sendMessage(Request $r)
    {
        $fromId = Auth()->id();
        $toId = $r->toId;
        $message = $r->message;

        Message::create([
            'from_user_id' => Auth()->id(),
            'to_user_id'  => $r->toId,
            'content' => $message,
        ]);


        return response()->json(['status' => true, 'message' => $this->getMessage($toId)]);
    }

    public function getMessage($to)
    {
        $fromid = Auth()->id();
        $data = Message::whereIn('from_user_id', [$fromid, $to])->whereIn('to_user_id', [$fromid, $to])->orderBy('created_at')->get();
        if ($data) {
            $messagesHtml = '';
            foreach ($data as $key => $value) {
                if ($value->from_user_view == 1) {
                    $messagesHtml .=  view('one-to-one-message', compact('value', 'fromid'))->render();
                } else {
                    if ($value->from_user_view != $fromid && $value->to_user_id != $fromid) {
                        $messagesHtml .=  view('one-to-one-message', compact('value', 'fromid'))->render();
                    }
                }
            }
        } else {
            $messagesHtml = "<h6> No prevous conversection Found. </h6>";
        }

        if ($messagesHtml == '') {
            $messagesHtml = '<h6 class="text-center p-3"> No prevous conversection Found. </h6>';
        }
        return $messagesHtml;
    }

    public function deleteMessage(Request $r)
    {
        $toUser = $r->toUserId;
        $fromUser = Auth()->id();

        // Delete if once delete it forever
        $getDeleteFromOnce =
            Message::whereIn('from_user_id', [$toUser, $fromUser])->whereIn('to_user_id', [$fromUser, $toUser])
            ->where('from_user_view', $toUser)->orderBy('created_at')->delete();

        // delete new message in my end
        $deleteNewMessages =
            Message::whereIn('from_user_id', [$toUser, $fromUser])->whereIn('to_user_id', [$fromUser, $toUser])
            ->where('from_user_view', 1)->update(['from_user_view' => $fromUser]);


        return response()->json(['status' => true, 'message' => "Successfully Deleted"]);
    }
}
