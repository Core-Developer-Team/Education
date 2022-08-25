<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Feedback;
use App\Models\Offlinetopic;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\ReqSolution;
use App\Models\Request as ModelsRequest;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        $datas = Feedback::orderBy('created_at', 'DESC')->cursorPaginate(6);
        $req_count = ModelsRequest::count();
        $feed_count = Feedback::count();
        $mysol = ReqSolution::where('user_id', Auth()->id())->count();
        $myques = ModelsRequest::where('user_id', Auth()->id())->count();
        $res  = Resource::count();
        $event = Event::count();
        $offline = Offlinetopic::count();
        $product = Product::count();
        $prop   = Proposal::count();
        return view('feedback', compact('datas', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'rating'       => 'required',
            'description'  => 'required|string',
        ]);

        Feedback::create(array_merge($request->only('description', 'rating'), [
            'user_id'   => auth()->id(),
        ]));
        return back()->with('status', 'Thanks for your Feedback :)');
    }
}
