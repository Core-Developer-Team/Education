<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Book;
use App\Models\Bookreview;
use App\Models\Course;
use App\Models\Playlist;
use App\Models\Product;
use App\Models\Proposalreview;
use App\Models\Review;
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
        //avg book rating
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
        //avg user rating

        $pureview  = Proposalreview::where('tp_user_id', $request->book_user)->get();
        $pavguser = 0;
        $ptuserrating = 0;
        $ptotal = $pureview->count();
        foreach ($pureview as $puser) {
            $pavguser = $pavguser + $puser->rating;
        }
        if ($ptotal > 0) {
            $ptotalrat = $pavguser / $ptotal;
            $ptuserrating   = number_format((float)$ptotalrat, 2, '.', '');
        }

        $ureview  = Review::where('t_user_id', $request->book_user)->get();
        $avguser = 0;
        $tuserrating = 0;
        $total = $ureview->count();
        foreach ($ureview as $user) {
            $avguser = $avguser + $user->rating;
        }
        if ($total > 0) {
            $totalrat = $avguser / $total;
            $tuserrating   = number_format((float)$totalrat, 2, '.', '');
        }

        $tutreview  = Playlist::where('user_id', $request->book_user)->get();
        $avgtutrat = 0;
        $trating = 0;
        $totaltut = $tutreview->count();
        foreach ($tutreview as $tut) {
            $avgtutrat = $avgtutrat + $tut->rating;
        }
        if ($totaltut > 0) {
            $totalrat = $avgtutrat / $totaltut;
            $trating   = number_format((float)$totalrat, 2, '.', '');
        }

        $courserev  = Course::where('user_id', $request->book_user)->get();
        $avgcourse = 0;
        $courating = 0;
        $totalcourse = $courserev->count();
        foreach ($courserev as $course) {
            $avgcourse = $avgcourse + $course->rating;
        }
        if ($totalcourse > 0) {
            $ctotal = $avgcourse / $totalcourse;
            $courating   = number_format((float)$ctotal, 2, '.', '');
        }

        $bookrev  = Book::where('user_id', $request->book_user)->get();
        $avgbook = 0;
        $bookrating = 0;
        $totalbook = $bookrev->count();
        foreach ($bookrev as $bok) {
            $avgbook = $avgbook + $bok->rating;
        }
        if ($totalbook > 0) {
            $btotal = $avgbook / $totalbook;
            $bookrating   = number_format((float)$btotal, 2, '.', '');
        }

        $prodrev  = Product::where('user_id', $request->book_user)->get();
        $avgprod = 0;
        $prod = 0;
        $totalprod = $prodrev->count();
        foreach ($prodrev as $produc) {
            $avgprod = $avgprod + $produc->rating;
        }
        if ($totalprod > 0) {
            $ptotal = $avgprod / $totalprod;
            $prod   = number_format((float)$ptotal, 2, '.', '');
        }

        $totaluserrating = $tuserrating + $ptuserrating + $trating + $courating + $bookrating + $prod;
        $no_rating = 0;
        if ($tuserrating > 0) {
            $no_rating += 1;
        }
        if ($ptuserrating > 0) {
            $no_rating += 1;
        }
        if ($trating > 0) {
            $no_rating += 1;
        }
        if ($courating > 0) {
            $no_rating += 1;
        }
        if ($bookrating > 0) {
            $no_rating += 1;
        }
        if ($prod > 0) {
            $no_rating += 1;
        }
        $useravgrating = $totaluserrating / $no_rating;
        $user = User::find($request->book_user);
        if ($user) {
            $user->rating = $useravgrating;
            $user->save();
        }

        // getting Badges details
        $users = User::where('id', $request->book_user)->first();

        $all_badges = Badge::all();
        foreach ($all_badges as $key => $badge) {
            $badge_name = $badge->name;
            switch ($badge_name) {
                case 'Medium level':
                    $medium_sol = $badge->solution;
                    $medium_rat = $badge->rating;
                    break;
                case 'Top rated':
                    $top_sol = $badge->solution;
                    $top_rat = $badge->rating;
                    break;
                case 'Verified':
                    $verified_sol = $badge->solution;
                    $verified_rat = $badge->rating;
                    break;
            }
        }

        if ($users->solutions >= $medium_sol && $users->solutions <= $top_sol) {
            $users->badge_id = 2;
        } elseif ($users->solutions > $top_sol && $users->solutions <= $verified_sol) {
            if ($users->rating >= $top_rat) {
                $users->badge_id = 3;
            } else {
                $users->badge_id = 2;
            }
        } elseif ($users->solutions > $verified_sol) {
            if ($users->rating >= $verified_rat) {
                $users->badge_id = 5;
            } else {
                $users->badge_id = 2;
            }
        }

        if (auth()->user()) {
            $book = Book::where('id', $request->book_id)->first();
            $user = User::find(auth()->user()->id);
            $data = User::find($request->book_user);
            $data->notify(new BookrevNotification($user, $book));
        }
        flash()->addSuccess('Thanks for your Review :)');
        return back();
    }
}
