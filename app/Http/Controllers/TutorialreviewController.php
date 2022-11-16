<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Course;
use App\Models\Playlist;
use App\Models\Product;
use App\Models\Proposalreview;
use App\Models\Review;
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
        //avg tutorial Rating
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

        //avg user rating

        $pureview  = Proposalreview::where('tp_user_id', $request->playlist_user)->get();
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

        $ureview  = Review::where('t_user_id', $request->playlist_user)->get();
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

        $tutreview  = Playlist::where('user_id', $request->playlist_user)->get();
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

        $courserev  = Course::where('user_id', $request->playlist_user)->get();
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

        $bookrev  = Book::where('user_id', $request->playlist_user)->get();
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

        $prodrev  = Product::where('user_id', $request->playlist_user)->get();
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

        $totaluserrating = $tuserrating+  $ptuserrating + $trating + $courating + $bookrating + $prod;
        $useravgrating = $totaluserrating / 6;
        $user = User::find($request->playlist_user);
        if ($user) {
            $user->rating = $useravgrating;
            $user->save();
        }

        if (auth()->user()) {
            $tutorial = Playlist::where('id',$request->playlist_id)->first();
            $user = User::find(auth()->user()->id);
            $data = User::find($request->playlist_user);
            $data->notify(new TutorialNotification($user, $tutorial));
        }
        flash()->addSuccess('Thanks for your Review :)');
        return back();
    }
}
