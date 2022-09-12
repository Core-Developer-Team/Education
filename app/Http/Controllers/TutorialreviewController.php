<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Tutorialreview;
use App\Models\User;
use App\Notifications\TutorialNotification;
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
        $avgrating = 0;
        $reviews = Tutorialreview::where('playlist_id', $request->playlist_id)->get();
        $totalreview = $reviews->count();
        foreach ($reviews as $review) {
            $avgrating = $avgrating + $review->rating;
        }
        $totalrat = $avgrating / $totalreview;
        $rating   = number_format((float)$totalrat, 2, '.', '');
        $tutorial =  Playlist::find($request->playlist_id);
        if ($tutorial) {
            $tutorial->rating = $rating;
            $tutorial->save();
        }

       

        return back()->with('status', 'Thanks for your Review :)');
    }
}
