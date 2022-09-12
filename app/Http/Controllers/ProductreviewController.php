<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Productreview;
use App\Models\User;
use App\Notifications\ProductrevNotification;
use Illuminate\Http\Request;

class ProductreviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating'       => 'required',
            'description'  => 'required|string',
        ]);

        Productreview::create(array_merge($request->only('description', 'rating'), [
            'user_id'   => auth()->id(),
            'product_id'   => $request->product_id,
        ]));
        $avgrating = 0;
        $reviews = Productreview::where('product_id', $request->product_id)->get();
        $totalreview = $reviews->count();
        foreach ($reviews as $review) {
            $avgrating = $avgrating + $review->rating;
        }
        $totalrat = $avgrating / $totalreview;
        $rating   = number_format((float)$totalrat, 2, '.', '');
        $product =  Product::find($request->product_id);
        if ($product) {
            $product->rating = $rating;
            $product->save();
        }

        if (auth()->user()) {
            $user = User::find(auth()->user()->id);
            $data = User::find($request->product_user);
            $data->notify(new ProductrevNotification($user));
        }

        return back()->with('status', 'Thanks for your Review :)');
    }
}
