<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
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
        $five = 0;
        $four = 0;
        $three = 0;
        $two = 0;
        $one = 0;
        $avgrating = 0;
        $reviews = Review::where('t_user_id', $request->t_user_id)->get();
        foreach ($reviews as $review) {

            if ($review->rating == 5) {
                $five = $five + $review->rating;
            }
            if ($review->rating == 4) {
                $four = $four + $review->rating;
            }
            if ($review->rating == 3) {
                $three = $three + $review->rating;
            }
            if ($review->rating == 2) {
                $two = $two + $review->rating;
            }
            if ($review->rating == 1) {
                $one = $one + $review->rating;
            }
        }
        $avgrating = (5 * $five + 4 * $four + 3 * $three + 2 * $two + 1 * $one) / ($five + $four + $three + $two + $one);
        $rating = number_format((float)$avgrating, 2, '.', '');
        $user = User::find($request->t_user_id);
        if ($user) {
            $user->rating = $rating;
            $user->save();
        }
        return back()->with('reciewstatus', 'Thanks for your Review :)');
    }
}
