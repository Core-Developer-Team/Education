<?php

namespace App\Http\Controllers;

use App\Models\Bookreview;
use Illuminate\Http\Request;

class BookreviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating'       => 'required',
            'description'  => 'required|string',
        ]);

        Bookreview::create(array_merge($request->only('description', 'rating'), [
            'user_id'   => auth()->id(),
            'book_id'   => $request->book_id,
        ]));
        return back()->with('status', 'Thanks for your Review :)');
    }
}
