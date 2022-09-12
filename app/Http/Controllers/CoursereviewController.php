<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Coursereview;
use App\Models\User;
use App\Notifications\CourseNotification;
use Illuminate\Http\Request;

class CoursereviewController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'rating'       => 'required',
            'description'  => 'required|string',
        ]);

        Coursereview::create(array_merge($request->only('description', 'rating'), [
            'user_id'   => auth()->id(),
            'course_id'   => $request->course_id,
        ]));
        $avgrating = 0;
        $reviews = Coursereview::where('course_id', $request->course_id)->get();
        $totalreview = $reviews->count();
        foreach ($reviews as $review) {
            $avgrating = $avgrating + $review->rating;
        }
        $totalrat = $avgrating / $totalreview;
        $rating   = number_format((float)$totalrat, 2, '.', '');
        $course =  Course::find($request->course_id);
        if ($course) {
            $course->rating = $rating;
            $course->save();
        }

        if (auth()->user()) {
            $user = User::find(auth()->user()->id);
            $data = User::find($request->course_user);
            $data->notify(new CourseNotification($user));
        }

        return back()->with('status', 'Thanks for your Review :)');
    }
}
