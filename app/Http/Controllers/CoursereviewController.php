<?php

namespace App\Http\Controllers;

use App\Models\Coursereview;
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
        return back()->with('status', 'Thanks for your Review :)');
    }
}
