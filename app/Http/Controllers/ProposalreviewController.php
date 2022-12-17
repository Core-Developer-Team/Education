<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Course;
use App\Models\Playlist;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\Proposalreview;
use App\Models\Review;
use App\Models\User;
use App\Notifications\PrevNotification;
use Illuminate\Http\Request;

class ProposalreviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating'       => 'required',
            'description'  => 'required|string',
        ]);

        Proposalreview::create(array_merge($request->only('description', 'rating'), [
            'fr_user_id'   => auth()->id(),
            'tp_user_id'   => $request->tp_user_id,
            'proposal_id'  => $request->proposal_id,
            'propsolution_id' => $request->propsolution_id,
        ]));
        $five = 0;
        $four = 0;
        $three = 0;
        $two = 0;
        $one = 0;
        $avgrating = 0;
        $reviews = Proposalreview::where('tp_user_id', $request->tp_user_id)->get();
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
        $user = User::find($request->tp_user_id);


        $ureview  = Review::where('t_user_id', $request->tp_user_id)->get();
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

        $tutreview  = Playlist::where('user_id', $request->tp_user_id)->get();
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

        $courserev  = Course::where('user_id', $request->tp_user_id)->get();
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

        $bookrev  = Book::where('user_id', $request->tp_user_id)->get();
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

        $prodrev  = Product::where('user_id', $request->tp_user_id)->get();
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

        $totaluserrating = $rating + $tuserrating + $trating + $courating + $bookrating + $prod;
        $useravgrating = $totaluserrating / 6;

        if ($user) {
            $user->rating = $useravgrating;
            $user->save();
        }


        if (auth()->user()) {
            $prorev = Proposal::where('id',$request->proposal_id)->first();
            $user = User::find(auth()->user()->id);
            $data = User::find($request->tp_user_id);
            $data->notify(new PrevNotification($user, $prorev));
        }

        flash()->addSuccess('Thanks for your Review:)');
        return back();
    }
}
