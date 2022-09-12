<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookreview;
use App\Models\User;
use App\Notifications\BookrevNotification;
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
        $avgrating = 0;
        $reviews = Bookreview::where('book_id', $request->book_id)->get();
        $totalreview = $reviews->count();
        foreach ($reviews as $review) {
            $avgrating = $avgrating + $review->rating;
        }
        $totalrat = $avgrating / $totalreview;
        $rating   = number_format((float)$totalrat, 2, '.', '');
        $book =  Book::find($request->book_id);
        if ($book) {
            $book->rating = $rating;
            $book->save();
        }

        if (auth()->user()) {
            $user = User::find(auth()->user()->id);
            $data = User::find($request->book_user);
            $data->notify(new BookrevNotification($user));
        }

        return back()->with('status', 'Thanks for your Review :)');
    }
}
