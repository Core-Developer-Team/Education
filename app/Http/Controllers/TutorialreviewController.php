<?php

namespace App\Http\Controllers;

use App\Models\Tutorialreview;
use Illuminate\Http\Request;

class TutorialreviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating'       => 'required',
            'description'  => 'required|string',
        ]);

        Tutorialreview::create(array_merge($request->only('description', 'rating'), [
            'user_id'   => auth()->id(),
            'playlist_id'   => $request->playlist_id,
        ]));
        return back()->with('status', 'Thanks for your Review :)');
    }
}
