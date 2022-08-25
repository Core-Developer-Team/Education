<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating'       => 'required',
            'description'  => 'required|string',
        ]);

        Review::create(array_merge($request->only('description', 'rating'), [
            'f_user_id'   => auth()->id(),
            't_user_id'   => $request->t_user_id,
        ]));
        return back()->with('reciewstatus', 'Thanks for your Review :)');
    }
}
